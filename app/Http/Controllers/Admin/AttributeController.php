<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.attributes.index');
        // return view('admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function draw(Request $request)
    {
        $query = Attribute::with('options');
        $draw = $request->get('draw');

        $start = $request->get("start");
        $total = $query->count();

        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr ? $columnIndex_arr[0]['column'] : 0; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr ? $order_arr[0]['dir'] : 'asc'; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        if ($searchValue) {
            $query->where(DB::raw("CONCAT(`name`,' ', `slug`,' ')"), 'like', '%' . $searchValue . '%')
            ->orWhere('id', $searchValue);
        }
        $totalRecordswithFilter = $query->count();
        $records = $query->orderBy($columnName, $columnSortOrder)->skip($start)->take($rowperpage)->get()->toArray();


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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeStoreRequest $request)
    {

        $validated = $request->validated();
        $validated['slug'] = str_replace(" ", "-", strtolower($validated['slug']));
        Attribute::create($validated);

        return redirect()->route('attributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {

        $options = AttributeOption::where('attribute_id', $attribute->id)->get();
        return view('admin.attributes.edit', ['attribute' => $attribute, 'options' => $options]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeUpdateRequest $request, Attribute $attribute)
    {
        $validated = $request->validated();
        $options = [];
        if (isset($validated['options'])) {
            $options = $validated['options']; // options@ pahum em arandzin var-i mech
            unset($validated['options']); // u jnjum em skbnakanic toxelov menak attributis veraberox@
        }
        $validated['slug'] = str_replace(" ", "-", strtolower($validated['slug']));
        $attribute->update($validated);

        $optionIds = [];
        $optionIdsForCreate = [];
        foreach ($options as $option) {
            if ($option['id']) {
                $optionIds[] = $option['id'];
                AttributeOption::where('id', $option['id'])->update(['name' => $option['name'], 'slug' => str_replace(" ", "-", strtolower($option['name'])), 'sku_part' => $option['sku_part']]);
            } else {
                $optionIdsForCreate[] = ['name' => $option['name'], 'slug' => str_replace(" ", "-", strtolower($option['name'])), 'attribute_id' => $attribute->id, 'sku_part' => $option['sku_part']];
            }
        }

        // delete removed id from list in database
        AttributeOption::where('attribute_id', $attribute->id)->whereNotIn('id', $optionIds)->delete();

        //create new options
        AttributeOption::insert($optionIdsForCreate);


        return redirect()->route('attributes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attribute $attribute)
    {
        try{
            DB::beginTransaction();
            $attribute->delete();
            DB::commit();
            return redirect()->back();
        }catch (\Exception $exception){
            DB::rollBack();
            report($exception);
            return redirect()->back()->with('error', "Attribute hasn't been deleted !");
        }

    }


    public function bulkActions(Request $request) {
        $selected = $request->get('selected', []);
        $action = $request->get('action');

        try{
            DB::beginTransaction();

            switch ($action) {
                case 'delete': {
                    Attribute::whereIn('id', $selected)->delete();
                    break;
                }
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            report($exception);
        }
    }
}
