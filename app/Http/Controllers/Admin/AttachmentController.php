<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttachmentController extends Controller
{

    public function index(Request $request)
    {

        if(!$request->ajax()) {
            return view('admin.attachments.index');
        }

        $data = ['page' => $_GET['page'] ?? 1, 'perPage' => $_GET['perPage'] ?? 22];

        $query = Attachment::query();

        if(isset($_GET['search']) && $_GET['search']) {
            $query = $query->search($_GET['search']);
        }

        $data['total'] = $query->count();
        $data['items'] = $query->orderByDesc('id')->skip(($data['page'] - 1) * $data['perPage'])->take($data['perPage'])->get();

        return response()->json($data);
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {

        Attachment::create($request->all());

        return redirect()->route('products.index');
    }

    public function update(Request $request, Attachment $attachment)
    {
        $attachment->update($request->all());

        return response()->json(['status' => 'OK']);
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $entity = Attachment::findOrFail($id);
            $entity->destroyFiles();
            $entity->delete();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            report($exception);
        }
        return response()->json(['status' => 'OK']);
    }
}
