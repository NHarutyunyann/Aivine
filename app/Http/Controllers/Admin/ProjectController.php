<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController;
use Illuminate\Http\Request;
use App\Models\AppModel;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ProjectController extends ResourceController
{
    protected $resource = 'projects';
    protected $modelName = 'Project';

    protected $drawWith = ['mainImage'];
    protected $editWith = [
        'mainImage',
        'attachments',
        'upsellProjects',
        'attributeOptions',
        'attributes',
        'tags',
    ];
    protected function drawFilters($query, $filters){
        if (isset($filters['stock_status']) && $filters['stock_status']) {
            $query->where('stock_status', $filters['stock_status']);
        }

        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['category']) && $filters['category']) {
            $catId = $filters['category'];
            $query->whereHas('categories', function ($q) use ($catId){
                $q->where('id', $catId);
            });
        }
        return $query;
    }

    protected function storeModel($validated){
        // if($validated['regular_price']) {
        //     if(isset($validated['sale_price']) && $validated['sale_price'] >= $validated['regular_price']) {
        //         return redirect()->back()->withInput()->withError('sale price is bigger then regular');
        //     }

        //     if(isset($validated['sale_price']) && (int)$validated['sale_price'] > 0) {
        //         $validated['price'] = $validated['regular_price'] - $validated['sale_price'];
        //     } else {
        //         $validated['price'] = $validated['regular_price'];
        //     }
        // } else {
        //     $validated['price'] = null;
        // }

        // $validated['stock_status'] = isset($validated['stock']) && $validated['stock'] > 0 ? 'in_stock' : 'out_of_stock';

        $relations = $validated['relations'];
        unset($validated['relations']);
        $entity = $this->model::create($validated);
        
        $this->syncRelations($entity, $relations);
        return $entity;
    }

    public function updateModel($entity, $validated){
        // dd($entity,$validated);
        // if($validated['regular_price']) {
        //     if(isset($validated['sale_price']) && $validated['sale_price'] >= $validated['regular_price']) {
        //         return redirect()->back()->withInput()->withError('sale price is bigger then regular');
        //     }
        //     if(isset($validated['sale_price']) && (int)$validated['sale_price'] > 0) {
        //         $validated['price'] = $validated['regular_price'] - $validated['sale_price'];
        //     } else {
        //         $validated['price'] = $validated['regular_price'];
        //     }
        // } else {
        //     $validated['price'] = null;
        // }
        // $validated['stock_status'] = isset($validated['stock']) && $validated['stock'] > 0 ? 'in_stock' : 'out_of_stock';
        $relations = $validated['relations'];
        unset($validated['relations']);
        $entity->update($validated);
        $this->syncRelations($entity, $relations);
        // dd($entity,$relations);
        return $entity;
    }

    public function copy($id){
        $product = $this->model::find($id);

        try {
            DB::beginTransaction();
            //copy attributes
            $new = $product->replicate();
            $new->created_at = Carbon::now();
            $new->title = $new->title ? $new->title . '-copy' : '';
            $new->slug  = $new->slug ? $new->slug . '-copy' : '';
            $new->status = AppModel::STATUS_INACTIVE;
            $new->save();

            $product->load('attachments', 'attributes', 'attributeOptions', 'categories');
            foreach ($product->getRelations() as $relationName => $values){
                if ($relationName === 'categories') {
                    foreach ($values as &$value) {
                        $value->product_count = $value->product_count + 1;
                    }
                }
                $new->{$relationName}()->sync($values);
            }

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
        }

        return redirect()->route($this->resource . '.edit', $new->id)->withSuccess('Successfully Copied!');
    }

    private function syncRelations($entity, $relations) {

        $entity->attachments()->sync($relations['attachments'] ?? []);
        $attributeOptions = [];
        $attributes = [];
        if(isset($relations['attributes'])) {
            foreach ($relations['attributes'] as $attribute) {
                if(isset($attribute['option_ids'])) {
                    $attributeOptions = array_merge($attributeOptions, $attribute['option_ids']);
                    $attributes[] = $attribute['id'];
                }
            }
        }
        $entity->tags()->sync($relations['tags']);

        $entity->attributeOptions()->sync($attributeOptions);

        $entity->attributes()->sync($attributes);

        $entity->upsellProjects()->sync($relations['upsell_projects'] ?? []);
    }

    public function updatePositions(Request $request) {
        $positions = $request->get('positions', []);

        foreach ($positions as $position) {
            Project::where('id', $position['id'])->update(['position' => $position['position']]);
        }
    }


    

    // protected function applyBulkAction($action, $selected)
    // {
    //     switch ($action) {
    //         case 'export': {
    //             return Excel::download(new ProductsExport($selected), 'products-export-' . date('y-m-d') . '.xlsx');
    //         }
    //     }
    // }
}
