<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait Searchable
{
    public static function scopeSearch($query, $keyword, $matchAllFields = false)
    {
        return $query->where(function ($query) use ($keyword, $matchAllFields) {

            foreach (static::getSearchableFields() as $field) {
                if ($matchAllFields) {
                    $query->where($field, 'LIKE', "%$keyword%");
                } else {
                    if (str_contains($field, '.')) {
                        $field = explode('.', $field);
                        $query->orWhereHas($field[0], function ($q) use ($field, $keyword){
                            return $q->where($field[1], 'LIKE', "%$keyword%");
                        });

                    } else {

                        $query->orWhere($field, 'LIKE', "%$keyword%");
                    }

                }
            }
            return $query;
        });
    }

    /**
     * Get all searchable fields
     *
     * @return array
     */
    public static function getSearchableFields()
    {
        $model = new static;

        $fields = $model->searchFields;

        if (empty($fields)) {
            $fields = Schema::getColumnListing($model->getTable());

            $ignoredColumns = [
                $model->getKeyName(),
                $model->getUpdatedAtColumn(),
                $model->getCreatedAtColumn(),
            ];

            if (method_exists($model, 'getDeletedAtColumn')) {
                $ignoredColumns[] = $model->getDeletedAtColumn();
            }

            $fields = array_diff($fields, $model->getHidden(), $ignoredColumns);
        }

        return $fields;
    }
}
