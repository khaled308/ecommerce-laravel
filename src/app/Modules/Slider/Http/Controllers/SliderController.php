<?php

namespace App\Modules\Slider\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Slider\Http\Requests\CreateSliderRequest;
use App\Modules\Slider\Models\Slider;
use App\Shared\FileUpload\FileUpload;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('slider::index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slider::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSliderRequest $request)
    {
        $image = FileUpload::upload($request->file('image'), 'sliders');

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'link' => $request->link,
            'price' => $request->price,
        ]);
        return redirect()->route('sliders.index')->with('success', 'Slider created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('slider::edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $image = $slider->image;
        if ($request->hasFile('image')) {
            FileUpload::delete($slider->image);
            $image = FileUpload::upload($request->file('image'), 'sliders');
        }

        $slider->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'link' => $request->link,
            'price' => $request->price,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        FileUpload::delete($slider->image);
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully');
    }
}
