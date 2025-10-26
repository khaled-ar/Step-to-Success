<?php

namespace App\Http\Controllers;

use App\Models\CoursesAd;
use Illuminate\Http\Request;
use App\Traits\Files;


class CoursesAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->generalResponse(CoursesAd::whereCourseId(request('course_id'))->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['image' => ['required', 'image', 'mimes:png,jpg', 'max:2048']]);
        $image = Files::moveFile($request->image, 'Images/Ads');
        CoursesAd::create(['image' => $image, 'course_id' => $request->course_id]);
        return $this->generalResponse(null, '201', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoursesAd $courses_ad)
    {
        Files::deleteFile(public_path("Images/Ads/{$courses_ad->image}"));
        $courses_ad->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
