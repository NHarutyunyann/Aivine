<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $items = [
            [
                'loc' => url('/'),
                'lastmod' => gmdate('Y-m-d\TH:i:s\Z', Carbon::now()->timestamp)
            ],
            [
                'loc' => url('/contacts'),
                'lastmod' => gmdate('Y-m-d\TH:i:s\Z', Carbon::now()->timestamp)
            ]
        ];

        return response()->view('front.sitemaps.sitemap', compact('items'))->header('Content-Type', 'text/xml');
    }


}