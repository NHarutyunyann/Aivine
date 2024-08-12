<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends ResourceController
{
    protected $resource = 'sliders';
    protected $modelName = 'Slider';
    protected $drawWith = ['mainImage'];


}
