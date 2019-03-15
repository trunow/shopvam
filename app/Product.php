<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'art', 'name'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Scope a query search.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySearch($query, $search)
    {
        return $search ? $query->where('name', 'LIKE', '%' . $search . '%') : $query;
    }
}
