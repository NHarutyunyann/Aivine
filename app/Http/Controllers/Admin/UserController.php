<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Models\UserDetail;
use App\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends ResourceController
{
    public function __construct(HelperService $helper)
    {
        parent::__construct($helper);
    }

    protected $resource = 'users';
    protected $modelName = 'User';
    protected $drawWith = ['roles'];

    public function drawFilters($query, $filters)
    {
        $query->whereHas('roles', function ($q) {
            $q->where('name', '<>', 'Super Admin');
        });

        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }
        return $query;
    }

    public function getUsers()
    {
        $search = @$_GET['q'];

        $query = $this->model::active();
        if($search) {
            $query = $query->search($search);
        }

        $result = $query->get();

        return response()->json(['items' => $result]);
    }

    protected function storeModel($validated)
    {
        $validated['password'] = Hash::make($validated['password']);

        $role = $validated['role'];
        unset($validated['role']);

        $entity = $this->model::create([
            // 'first_name' => $validated['first_name'],
            // 'last_name' => $validated['last_name'],
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            // 'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'status' =>  $validated['status'],
        ]);
        $entity->roles()->sync([$role]);

        UserDetail::create([
            'user_id' => $entity->id,
            'contact_details' => $validated['contact_details'] ?? null,
            'address' => $validated['address'] ?? null,
            'shipping_address' => $validated['shipping_address'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'city' => $validated['city'] ?? null,
        ]);

        return $entity;
    }

    public function updateModel($entity, $validated)
    {
        $password = @$validated['password'];
        unset($validated['password']);

        $role = $validated['role'];
        unset($validated['role']);

        $entity->update([
            // 'first_name' => $validated['first_name'],
            // 'last_name' => $validated['last_name'],
            'name' => $validated['name'],
            // 'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'status' =>  $validated['status'],
        ]);

        if($password) {
            $entity->update(['password' => Hash::make($password)]);
        }

        $entity->roles()->sync([$role]);

        $entity->details()->update([
            'user_id' => $entity->id,
            'contact_details' => $validated['contact_details'] ?? null,
            'address' => $validated['address'] ?? null,
            'shipping_address' => $validated['shipping_address'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'city' => $validated['city'] ?? null,
        ]);

        return $entity;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    protected function applyBulkAction($action, $selected)
    {
        switch ($action) {
            case 'export': {
                return Excel::download(new UsersExport($selected), 'users-export-' . date('y-m-d') . '.xlsx');
            }
        }
    }

    public function exportAll()
    {
        return Excel::download(new UsersExport(), 'users-export-' . date('y-m-d') . '.xlsx');
    }
}
