<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LessonDuration;
use Illuminate\Http\Request;

class LessonDurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $duration = LessonDuration::get()->all();
        return $duration;
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
            'duration' => 'required|integer',
            'active' => 'required|boolean'
        ]);
    
        $duration = LessonDuration::create($validated);
        if($duration){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonDuration  $lessonDuration
     * @return \Illuminate\Http\Response
     */
    public function show(LessonDuration $lessonDuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonDuration  $lessonDuration
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonDuration $lessonDuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonDuration  $lessonDuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonDuration $lessonDuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonDuration  $lessonDuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonDuration $lessonDuration)
    {
        //
    }
}
