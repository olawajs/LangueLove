<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiscountPacket;
use Illuminate\Http\Request;

class DiscountPacketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packet = DiscountPacket::get()->all();
        return $packet;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_type_id' => 'required|integer',
            'discount' => 'required|integer',
            'amount' => 'required|integer'
        ]);
    
        $packet = DiscountPacket::create($validated);
        if($packet){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscountPacket  $discountPacket
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountPacket $discountPacket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscountPacket  $discountPacket
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountPacket $discountPacket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiscountPacket  $discountPacket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscountPacket $discountPacket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscountPacket  $discountPacket
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountPacket $discountPacket)
    {
        //
    }
}
