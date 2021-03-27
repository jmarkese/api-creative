<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use App\Services\Interfaces\ICreativeService;
use Illuminate\Http\Request;

class CreativeController extends Controller
{
    public function __construct(private ICreativeService $creativeService)
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
        $userId = $request->header('X-User-Id');
        $creatives = $this->creativeService->getCreativesByUserId($userId);
        return response()->json($creatives);
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
        $creative = $this->creativeService->createCreative($request->all(), $userId);
        return response()->json($creative, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // You would normally get this from a JWT claim or Client ID lookup
        $userId = $request->header('X-User-Id');
        $creative = $this->creativeService->getCreativeByUserIdAndId($id, $userId);
        return response()->json($creative);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Creative $creative, Request $request)
    {
        // You would normally get this from a JWT claim or Client ID lookup
        $userId = $request->header('X-User-Id');
        $creative = $this->creativeService->updateCreativeByUserIdAndId($creative, $userId, $request->all());
        return response()->json($creative);
    }
}
