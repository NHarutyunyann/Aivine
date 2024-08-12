<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HelperService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $helper;

    public function __construct(HelperService $helper)
    {
        $this->helper = $helper;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function slugify(Request $request)
    {
        return response()->json(['slug' => $this->helper->slugify($request->get('text'))]);
    }
}
