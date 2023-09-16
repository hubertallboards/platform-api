<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
