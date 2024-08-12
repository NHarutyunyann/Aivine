<?php

namespace App\Models;

class UserDetail extends AppModel
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'id', 'user_id');
    }
}
