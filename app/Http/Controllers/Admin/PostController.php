<?php

namespace App\Http\Controllers\Admin;

class PostController extends ResourceController
{
    protected $resource = 'posts';
    protected $modelName = 'Post';

    public function drawFilters($query, $filters)
    {
        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }
        return $query;
    }
}
