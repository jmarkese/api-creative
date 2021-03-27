<?php

namespace App\Http\Controllers;

use App\OutputFormatters\Order\OrderOutputFormatterFactory;
use App\Services\Interfaces\IOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct(private IOrderService $orderService)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->header('X-User-Id');
        $order = $this->orderService->createOrderByUserId($request->all(), $userId);
        return response()->json($order, 201);
    }

}
