<?php

namespace App\Http\Controllers\Admin;

class PartnerController extends ResourceController
{
    protected $resource = 'partners';
    protected $modelName = 'Partner';

    protected $drawWith = ['mainImage'];
}
