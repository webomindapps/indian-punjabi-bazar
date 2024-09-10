<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubscriberExport;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewsLetterController extends Controller
{
    public function index()
    {
        $searchColumns = ['id', 'email'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $from_date = request()->from_date;
        $to_date = request()->to_date;
        $query = Newsletter::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        } elseif ($from_date) {
            $query->whereDate('created_at', $from_date);
        } elseif ($to_date) {
            $query->whereDate('created_at', $to_date);
        }        
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $subscribers = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.newsletter.index', compact('subscribers'));
    }
    public function subscription(Request $request)
    {
        $request->validate(['email' => 'required|unique:newsletters']);
        Newsletter::create(['email' => $request->email]);
        return back()->with('message', 'Subscribed successfully');
    }

    public function edit($id)
    {
        $subscriber = Newsletter::find($id);
        return view('admin.newsletter.edit', compact('subscriber'));
    }

    public function update(Request $request, $id)
    {
        $subscriber = Newsletter::find($id);
        $subscriber->update([
            'email' => $request->email,
            'is_subscribed' => $request->is_subscribed
        ]);
        return redirect()->route('newsletters')->with('message', 'Subscriber updated successfully');
    }

    public function destroy($id)
    {
        Newsletter::destroy($id);
        return back()->with('message', 'Subscribed deleted successfully');
    }

    public function export()
    {
        return Excel::download(new SubscriberExport, 'subscribers.xlsx');
    }
}
