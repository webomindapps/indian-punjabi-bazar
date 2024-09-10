<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Mail\CancelOrderMail;
use App\Mail\InvoiceMail;
use App\Models\HomeSetting;
use App\Models\Order;
use App\Models\Refund;
use App\Models\RefundItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function model()
    {
        return new Order;
    }
    public function index()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'phone', 'email', 'grand_total'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $delivery_type = request()->delivery_type;
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $query = $this->model()->query();
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($delivery_type) {
            $query->where('delivery_type', $delivery_type);
        }
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $orders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.orders.index', compact('orders'));
    }
    public function details($id)
    {
        $order = Order::find($id);
        return view('admin.orders.details', compact('order'));
    }
    public function deliveryUpdate(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update(['delivery_date' => $request->delivery_date]);
        return back()->with('success','Order delivery date updated successfully');
    }

    public function generateInvoice($id)
    {
        $order = Order::find($id);
        $order->update([
            'is_invoice_created' => true,
            'invoice_date'       => date('Y-m-d'),
            'status'             => 'Invoice Created',
        ]);
        $email = $order->email;
        if ($email) {
            Mail::to($email)->send(new InvoiceMail($order));
        }
        $setting = HomeSetting::first();
        $emails = explode(",", $setting->admin_mails);
        if ($emails) {
            Mail::to($emails)->send(new InvoiceMail($order));
        }
        return back()->with('message', 'Invoice generated successfully');
    }
    public function shipmentCreate($id)
    {
        $order = Order::find($id);
        return view('admin.orders.shipment-create', compact('order'));
    }
    public function shipmentStore(Request $request, $id)
    {
        $request->validate([
            'shipment_name'  => 'required',
            'shipped_date'   => 'required',
        ]);
        $order = Order::find($id);
        $order->update([
            'is_shipped'         => true,
            'shipped_date'       => $request->shipped_date,
            'status'             => 'Shipped',
            'shipment_name'      => $request->shipment_name,
            'shipment_id'        => $request->shipment_id,
            'tracking_id'        => $request->tracking_id,
        ]);
        return redirect()->route('order.details', $order->id)->with('message', 'Order shipped successfully');
    }
    public function refund($id)
    {
        $order = Order::find($id);
        return view('admin.orders.refund-create', compact('order'));
    }
    public function refundStore(Request $request, $id)
    {
        $request->validate([
            'refund_amt' => 'required',
        ]);
        $order = Order::find($id);
        $order->update([
            'is_refunded'   => true,
            'refund_date'   => date('Y-m-d')
        ]);
        $refund = Refund::create([
            'order_id'      => $id,
            'refund_date'   => date('Y-m-d'),
            'total_amount'  => $request->total_amt,
            'refund_amount' => $request->refund_amt,
        ]);
        $items=explode(",", $request->items);
        foreach ($items as $item) {
            RefundItem::create([
                'order_id'      => $id,
                'refund_id'     => $refund->id,
                'order_item_id' => $item
            ]);
        }
        return redirect()->route('order.details', $order->id)->with('message', 'Refunded successfully');
    }

    public function getInvoices()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'phone', 'email', 'grand_total'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $delivery_type = request()->delivery_type;
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $query = $this->model()->query();
        $query->where('is_invoice_created', true);
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($delivery_type) {
            $query->where('delivery_type', $delivery_type);
        }

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $orders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.orders.invoices', compact('orders'));
    }
    public function invoiceDetails($id)
    {
        $order = Order::find($id);
        return view('admin.orders.invoice-details', compact('order'));
    }
    public function getShipments()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'phone', 'email', 'grand_total'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $delivery_type = request()->delivery_type;
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $query = $this->model()->query();
        $query->where('is_shipped', true);
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($delivery_type) {
            $query->where('delivery_type', $delivery_type);
        }

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $orders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.orders.shipments', compact('orders'));
    }
    public function getRefunds()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'phone', 'email', 'grand_total'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $delivery_type = request()->delivery_type;
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $query = $this->model()->query();
        $query->where('is_refunded', true);
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($delivery_type) {
            $query->where('delivery_type', $delivery_type);
        }

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $orders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.orders.refunds', compact('orders'));
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'cancelled']);
        $email = $order->email;
        if ($email) {
            Mail::to($email)->send(new CancelOrderMail($order));
        }
        $setting = HomeSetting::first();
        $emails = explode(",", $setting->admin_mails);
        if ($emails) {
            Mail::to($emails)->send(new CancelOrderMail($order));
        }
        return back()->with('message', 'Order cancelled successfully');
    }
    public function export(Request $request)
    {
        $from_date = $request->fromDt;
        $to_date = $request->toDt;
        $query = Order::query();
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        $orders = $query->get();
        return Excel::download(new OrderExport($orders), 'orders.xlsx');
    }

    public function generatePdf($id)
    {
        $order = Order::find($id);
        $homesetting=HomeSetting::first();
        $pdf = Pdf::loadView('admin.orders.pdf', [
            'order' => $order,
            'homesetting' => $homesetting,
        ]);
        return $pdf->stream('invoice.pdf');
    }
}
