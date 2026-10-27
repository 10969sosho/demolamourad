<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'tag', 'category', 'time', 'level', 'desc', 'image', 'color', 'price', 'link', 'sort_order', 'is_active', 'is_featured', 'is_showcase'])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_showcase' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
