<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class AppModel extends Model
{
    use HasFactory, Searchable;

    const rules = [];
    const createRules = null;
    const updateRules = null;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_PRIVATE = 'private';

    const ALL_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_PRIVATE
    ];

    protected $guarded = [];

    //SCOPE STATUSES
    public function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeActiveOrPrivate($query) {
        return $query->whereIn('status', [self::STATUS_ACTIVE, self::STATUS_PRIVATE]);
    }

    public function scopeInactive($query) {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public function scopePrivate($query) {
        return $query->where('status', self::STATUS_PRIVATE);
    }

    public function scopeStatusIn($query, $statuses) {
        return $query->whereIn('status', $statuses);
    }

    public static function getUpdateValidationRules($id) {
        $class = get_called_class();
        $rules = array_merge($class::rules, $class::updateRules ?? []);

        foreach($rules as $key => $rule) {
            $rules[$key] = str_replace('{{id}}', $id, $rule);
        }
        // dd($rules);

        return $rules;
    }

    public static function getStoreValidationRules() {
        $class = get_called_class();
        return array_merge($class::rules, $class::createRules ?? []);
    }
}
