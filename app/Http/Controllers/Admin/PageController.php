<?php

namespace App\Http\Controllers\Admin;

class PageController extends ResourceController
{
    protected $resource = 'pages';
    protected $modelName = 'Page';

    public function drawFilters($query, $filters)
    {
        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }
        return $query;
    }
}
