<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhysicalLocation extends Model
{
    protected $fillable = [
        'book_id',
        'shelf',
        'aisle',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
