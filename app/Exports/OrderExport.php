<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class OrderExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $orders;
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        return view('admin.orders.exports.index', [
            'orders' => $this->orders
        ]);
    }
}
