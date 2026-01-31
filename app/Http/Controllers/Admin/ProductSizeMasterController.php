<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SizeMaster;
use Illuminate\Http\Request;

class ProductSizeMasterController extends Controller
{
    public function index()
    {
        $sizeMaster = SizeMaster::all();
        return view('Admin.sizemaster.index', compact('sizeMaster'));
    }

    public function create()
    {
        return view('Admin.sizemaster.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required',
        ]);
        $sizeMaster = new SizeMaster();
        $sizeMaster->size = $request->size;

        $sizeMaster->status = $request->status == 'Y' ? 'Y' : 'N';

        $sizeMaster->save();

        return redirect()->route('productSizeMaster.index')
            ->with('success', 'Size created successfully');
    }

    public function edit($id)
    {
        $sizeMaster = SizeMaster::find($id);
        return view('Admin.sizemaster.edit', compact('sizeMaster'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|numeric',
        ]);

        $sizeMaster = SizeMaster::find($id);
        $sizeMaster->size = $request->size;

        if ($sizeMaster->status) {
            $sizeMaster->status = 'Y';
        } else {
            $sizeMaster->status = 'N';
        }
        $sizeMaster->save();

        return redirect()->route('productSizeMaster.index')
            ->with('success', 'Size updated successfully');
    }

    public function delete($id)
    {
        $sizeMaster = SizeMaster::find($id);
        $sizeMaster->delete();
        return redirect()->route('productSizeMaster.index')
            ->with('success', 'Size deleted successfully');
    }
}
