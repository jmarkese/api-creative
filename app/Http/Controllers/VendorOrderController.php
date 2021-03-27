<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OutputFormatters\Order\OrderOutputFormatterFactory;
use App\Services\Interfaces\IOrderService;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    /**
     * VendorOrderController constructor.
     */
    public function __construct(private IOrderService $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // You would normally get this from a JWT claim or Client ID lookup
        $vendorId = $request->header('X-Vendor-Id');
        $orders = $this->orderService->getVendorOpenOrdersByVendorSlug($vendorId);
        $outputFormatter = OrderOutputFormatterFactory::make($vendorId);
        return response($outputFormatter->output($orders), 200)->header('Content-Type', $outputFormatter->contentType());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->orderService->updateVendorOrderById($id, $request->all());
        return response()->json($order);
    }
}
