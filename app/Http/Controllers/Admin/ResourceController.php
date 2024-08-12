<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\Tag;
use App\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    protected $helper;

    protected $view;
    protected $modelName;
    /**
     * @var AppModel
     */
    protected $model;
    protected $resource;

    protected $drawWith = [];
    protected $editWith = [];

    public function __construct(HelperService $helper)
    {
        $this->view = $this->view ?? $this->resource;
        $this->model = 'App\Models\\' . $this->modelName;
        $this->helper = $helper;
    }

    public function index()
    {
        $view = 'admin.' . $this->view . '.index';
        if(!view()->exists($view)) {
            $view = 'admin.model.index';
        }

        return view($view, $this->getViewData());
    }

    public function draw(Request $request)
    {
        $query = $this->model::with($this->drawWith);
        $totalRecords = $query->count();

        $orderBy = $request->get('columns')[$request->get('order') ? $request->get('order')[0]['column'] : 0]['data'];
        $order = $request->get('order') ? $request->get('order')[0]['dir'] : 'asc';

        $query->search($request->get('search')['value']);

        $filters = $request->get('filters', []);
        if(count($filters)) {
            $query = $this->drawFilters($query, $filters);
        }

        $drawFilterQuery = clone $query;

        $filterLinks = $request->get('filterLinks', []);
        if(is_array($filterLinks) && count($filterLinks)) {
            $query = $this->applyFilterLink($query, $filterLinks);
        }

        $totalRecordsWithFilter = $query->count();

        $records = $query->orderBy($orderBy, $order)->skip($request->get("start"))->take($request->get("length"))->get();
        $response = array(
            "draw" => intval($request->get('draw')),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData" => $records,
            'filterLinks' => $this->drawFilterLinks($drawFilterQuery)
        );

        return response()->json($response);
    }

    public function create()
    {
        $view = 'admin.' . $this->view . '.create';
        if(!view()->exists($view)) {
            $view = 'admin.model.create';
        }

        return view($view, $this->getViewData());
    }

    public function store(Request $request){
        // dd($request->all());

        $validated = $request->validate($this->model::getStoreValidationRules());
        $entity = $this->storeModel($validated);

        return redirect()->route($this->resource . '.edit', $entity->id)->withSuccess('Successfully Created!');
        // return redirect()->back();
    }

    public function edit($id){
        $entity = $this->model::with($this->editWith)->findOrFail($id);
        $view = 'admin.' . $this->view . '.edit';
        if(!view()->exists($view)){
            $view = 'admin.model.edit';
        }
        return view($view, array_merge($this->getViewData(), ['entity' => $entity]));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $entity = $this->model::findOrFail($id);

        $validated = $request->validate($this->model::getUpdateValidationRules($id));
        $this->updateModel($entity, $validated);
        
        return redirect()->route($this->resource . '.edit', $entity->id)->withSuccess('Successfully Updated!');
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $entity = $this->model::findOrFail($id);
            $entity->delete();

            DB::commit();
            return redirect()->back();
        }catch (\Exception $exception){
            DB::rollBack();
            report($exception);
            return redirect()->back()->with('error', $this->modelName . " hasn't been deleted !");
        }
    }

    public function search() {
        $search = @$_GET['q'];

        $result = [];
        if($search) {
            $result = $this->model::active()->search($search)->get();
        }

        return response()->json(['items' => $result]);
    }

    public function bulkActions(Request $request) {
        $selected = $request->get('selected', []);
        $action = $request->get('action');

        try{
            DB::beginTransaction();

            switch ($action) {
                case 'delete': {
                    $response = $this->model::whereIn('id', $selected)->delete();
                    break;
                }
                default: {
                    $response = $this->applyBulkAction($action, $selected);
                }
            }

            DB::commit();
            return $response;
        }catch (\Exception $exception){
            DB::rollBack();
            report($exception);
        }
    }

    protected function drawFilters($query, $filters) {
        return $query;
    }

    public function applyFilterLink($query, $filterLinks)
    {
        return $query;
    }

    public function drawFilterLinks($drawFilterQuery) {
        return [];
    }

    protected function applyBulkAction($action, $selected) {return;}

    protected function storeModel($validated) {
        // dd($validated);
        return $this->model::create($validated);
    }

    protected function updateModel($entity, $validated) {
        return $entity->update($validated);
    }

    private function getViewData()
    {
        return [
            'modelName' => $this->modelName,
            'resource' => $this->resource,
        ];
    }
}
