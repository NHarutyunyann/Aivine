<?php

namespace App\Models;

class Question extends AppModel
{
    const rules = [
        'status' => 'required|string',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'main_image' => 'numeric|nullable',
    ];

    //RELATIONS
    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'main_image');
    }
}
