<?php

namespace App\Http\Controllers\Admin;

class ProductController extends ResourceController{
    protected $resource = 'products';
    protected $modelName = 'Product';

    protected $drawWith = ['mainImage', 'attachments'];
    protected $editWith = ['mainImage', 'attachments'];

    public function updateModel($entity, $validated){
        $relations = @$validated['relations'];
        unset($validated['relations']);

        $entity->update($validated);

        $this->syncRelations($entity, $relations);
        return $entity;
    }

    private function syncRelations($entity, $relations){
        $entity->attachments()->sync($relations['attachments'] ?? []);
    }
}
