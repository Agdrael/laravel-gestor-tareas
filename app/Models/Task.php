<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'completed',
        'due_date',
    ];

    protected function casts(): array
    {
        return[
            'completed'=>'boolean',
            'due_date'=>'date',
        ];
    }
     public function category(): BelongsTo
     {
        return $this->belongsTo(Category::class);
     }
}
