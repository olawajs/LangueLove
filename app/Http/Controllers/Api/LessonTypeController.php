<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LessonType;
use Illuminate\Http\Request;

class LessonTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = LessonType::get()->all();
        return $types;
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
    
        $type = LessonType::create($validated);
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
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function show(LessonType $lessonType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonType $lessonType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonType $lessonType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonType $lessonType)
    {
        //
    }
}
