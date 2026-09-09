<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }
}
