<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends AppModel
{
    const rules = [
        'status' => 'required|string',
        'price' => 'required|numeric',
        'main_image' => 'numeric|nullable',
    ];

    //RELATIONS
    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'main_image');
    }
}
