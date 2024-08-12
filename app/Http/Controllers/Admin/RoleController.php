<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index');
    }

    public function draw(Request $request)
    {
        $query = Role::where('name', '<>', 'Super Admin');
        $draw = $request->get('draw');
        $start = $request->get("start");
        $total = $query->count();

        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        if($searchValue) {
            $query->where('name', 'like', '%' .$searchValue . '%');
        }

        $totalRecordswithFilter = $query->count();

        $records = $query->orderBy($columnName,$columnSortOrder)->skip($start)->take($rowperpage)->get()->toArray();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $records
        );

        return response()->json($response);
    }

    public function create()
    {
        $permissions = Permission::All();
        return view('admin.role.create', ['permissions' => $permissions]);
    }

    public function store(RoleStoreRequest $request)
    {
        $validated = $request->validated();

        // $permissions = $validated['permissions'];
        // unset($validated['permissions']);

        $role = Role::create($validated);

        // $role->syncPermissions($permissions);

        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        //dd
    }

    public function edit(Role $role)
    {
        // $permissions = Permission::All();
        return view('admin.role.edit', ['role' => $role]);
        // return view('admin.role.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $validated = $request->validated();

        // $permissions = $validated['permissions'];
        // unset($validated['permissions']);

        $role->update($validated);

        // $role->syncPermissions($permissions);

        return redirect()->route('roles.index');
    }
}
