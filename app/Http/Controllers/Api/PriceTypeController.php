<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = PriceType::get()->all();
        return $type;
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
            'name' => 'required|string|max:255',
            'active' => 'required|boolean'
        ]);
    
        $type = PriceType::create($validated);
        if($type){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function show(PriceType $priceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceType $priceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceType $priceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceType $priceType)
    {
        //
    }
}
