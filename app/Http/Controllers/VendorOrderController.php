<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorOrderIndexRequest;
use App\Http\Requests\VendorOrderUpdateRequest;
use App\Models\Order;
use App\OutputFormatters\IOutputFormatterFactory;
use App\OutputFormatters\Order\OrderOutputFormatterFactory;
use App\Services\Interfaces\IOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorOrderController extends Controller
{
    /**
     * VendorOrderController constructor.
     */
    public function __construct(private IOrderService $orderService, private IOutputFormatterFactory $outputFormatterFactory)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param  VendorOrderIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(VendorOrderIndexRequest $request)
    {
        $vendorSlug = $userId = auth()->user()->vendor->slug;
        $orders = $this->orderService->getVendorOpenOrdersByVendorSlug($vendorSlug);
        $outputFormatter = $this->outputFormatterFactory->make($vendorSlug, "order");
        return response($outputFormatter->output($orders), 200)->header('Content-Type', $outputFormatter->contentType());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VendorOrderUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorOrderUpdateRequest $request, $id)
    {
        $order = $this->orderService->updateVendorOrderById($id, $request->all());
        return response(Response::HTTP_NO_CONTENT);
    }
}
