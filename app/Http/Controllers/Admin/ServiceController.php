<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppModel;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ServiceController extends ResourceController
{
    protected $resource = 'services';
    protected $modelName = 'Service';

}
