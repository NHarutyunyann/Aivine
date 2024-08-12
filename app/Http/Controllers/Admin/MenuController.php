<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;

class MenuController extends ResourceController
{
    protected $resource = 'menus';
    protected $modelName = 'Menu';

    public function storeModel($validated) {
        $validated['active'] = isset($validated['active']);
        $activeMenus = false;

        if ($validated['active']){
            $activeMenus = Menu::query()->where('type', $validated['type'])->where('active', 1)->update(['active' => 0]);
        }

        $entity = $this->model::create($validated);

        if ($validated['active'] && $activeMenus){
            redirect()->route($this->resource . '.edit', ['menu' => $entity->id])->withSuccess('We have already active menu!');
        }

        return $entity;
    }

    public function updateModel($entity, $validated) {
        $validated['active'] = isset($validated['active']);
        $activeMenus = false;

        if ($validated['active']){
            $activeMenus = Menu::query()->where('type', $validated['type'])->where('active', 1)->update(['active' => 0]);
        }

        $entity->update($validated);

        if ($validated['active'] && $activeMenus){
            redirect()->route($this->resource . '.edit', ['menu' => $entity->id])->withSuccess('We have already active menu!');
        }

        return $entity->update($validated);
    }
}
