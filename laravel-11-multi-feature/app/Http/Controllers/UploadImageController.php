<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{

    public function index()
    {
        return view('Task1.uploadImage');
    }

    public function store(Request $request)
    {

        $request->validate([
          'image' => 'required|image|mimes:png,jpg,jpeg, gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        return back()->with('success', 'Image uploaded successfully');
    }
}
