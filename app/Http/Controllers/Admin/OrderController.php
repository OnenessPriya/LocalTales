<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\OrderContract;
use App\Models\Order;
class OrderController extends BaseController
{
// private OrderInterface $orderRepository;

public function __construct(OrderContract $orderRepository)
{
    $this->orderRepository = $orderRepository;
}

public function index(Request $request)
{
    if (!empty($request->status)) {
        if (!empty($request->term)) {
            $data = $this->orderRepository->listByStatus($request->status);
            $data = $this->orderRepository->searchOrder($request->term);
        } else {
            $data = $this->orderRepository->listByStatus($request->status);
        }
    } else {
        $data = $this->orderRepository->listAll();
    }

    return view('admin.order.index', compact('data'));
}


}
