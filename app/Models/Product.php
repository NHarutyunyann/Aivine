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
        'relations.attachments' => 'nullable|array',
    ];

    //RELATIONS
    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'main_image');
    }
    
    public function attachments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'product_attachment');
    }
}
