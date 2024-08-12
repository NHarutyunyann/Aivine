<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, HasRoles, Searchable;

    protected $appends = ['full_name'];
    protected $guarded = [];

    const rules = [
        'name' => 'required|string|max:100',
        'phone_number' => 'required|string|max:225',
        'email' => 'required|unique:users|string|max:100',
        'password' => 'required|string|min:6|max:50',
        'role' => 'required|string',
        'status' => 'required|string',
    ];

    public const updateRules = [
        'email' => 'required|string|max:1000|unique:users,email,{{id}}',
        'password' => 'nullable|string|max:50',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const ALL_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    // protected $searchFields = ['nickname', 'first_name', 'last_name', 'email'];
    protected $searchFields = [ 'name', 'email'];

    //SCOPE STATUSES
    public function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeInactive($query) {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public static function getUpdateValidationRules($id) {
        $class = get_called_class();
        $rules = array_merge($class::rules, $class::updateRules ?? []);

        foreach($rules as $key => $rule) {
            $rules[$key] = str_replace('{{id}}', $id, $rule);
        }

        return $rules;
    }

    public static function getStoreValidationRules() {
        $class = get_called_class();
        return $class::rules;
    }

    //    TODO: MUTATIONS
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    //    TODO: RELATIONS
    public function details(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    // public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    // {
    //     return $this->hasMany(Order::class, 'user_id', 'id');
    // }
}
