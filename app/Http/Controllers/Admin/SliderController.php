<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('Admin.slider.index', compact('slider'));
    }

    public function create()
    {
        return view('Admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'sortOrder' => 'required|numeric',
        ]);
        $slider = new Slider();
        if ($request->image) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('collection/slider/image');
            $image->move($destinationPath, $imageName);
            $slider->image = $imageName;
        }
        $slider->sortOrder = $request->sortOrder;
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('Admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'sortOrder*' => 'required|numeric',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->sortOrder = $request->sortOrder;
        if ($request->hasFile('image')) {
            if ($slider->image && file_exists(public_path('collection/slider/image/' . $slider->image))) {
                unlink(public_path('collection/slider/image/' . $slider->image));
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('collection/slider/image'), $imageName);
            $slider->image = $imageName;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider update successfully.');
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image && file_exists(public_path('collection/slider/image/' . $slider->image))) {
            unlink(public_path('collection/slider/image/' . $slider->image));
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }
}
