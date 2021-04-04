<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\OutputFormatters\Order\OrderOutputFormatterFactory;
use App\Services\Interfaces\IOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param  OrderStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $userId = auth()->user()->id;
        $order = $this->orderService->createOrderByUserId($request->all(), $userId);
        return response()->json($order, Response::HTTP_CREATED);
    }

}
