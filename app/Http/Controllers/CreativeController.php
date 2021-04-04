<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreativeShowRequest;
use App\Http\Requests\CreativeStoreRequest;
use App\Http\Requests\CreativeUpdateRequest;
use App\Models\Creative;
use App\Services\Interfaces\ICreativeService;
use Illuminate\Http\Response;

class CreativeController extends Controller
{
    public function __construct(private ICreativeService $creativeService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $creatives = $this->creativeService->getCreativesByUserId($userId);
        return response()->json($creatives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreativeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreativeStoreRequest $request)
    {
        $userId = auth()->user()->id;
        $creative = $this->creativeService->createCreative($request->all(), $userId);
        return response()->json($creative, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  CreativeShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, CreativeShowRequest $request)
    {
        $userId = auth()->user()->id;
        $creative = $this->creativeService->getCreativeByUserIdAndId($id, $userId);
        return response()->json($creative);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  CreativeUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Creative $creative, CreativeUpdateRequest $request)
    {
        $userId = auth()->user()->id;
        $this->creativeService->updateCreativeByUserIdAndId($creative, $userId, $request->all());
        return response(Response::HTTP_NO_CONTENT);
    }
}
