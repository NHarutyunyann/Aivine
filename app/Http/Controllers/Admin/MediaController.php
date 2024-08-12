<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $items = Attachment::all();
        return view('admin.product.index', ['items' => $items]);
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'attachment' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,csv,xls,xlsx|max:8000',
        ]);

        $uploaded = Attachment::upload($request->file('attachment'));

        if(!$uploaded) {
            return response()->json(['success' => false]);
        }
        $created = Attachment::create([
            'name' => $uploaded['name'],
            'alt' => $uploaded['name'],
            'path' => $uploaded['path'],
            'format' => $uploaded['format'],
            'size' => @$uploaded['size'],
            'width' => @$uploaded['width'],
            'height' => @$uploaded['height'],
        ]);

        return response()->json(['success' => true, 'item' => $created]);
    }
}
