<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    protected $fillable = [
        'publisher_id',
        'title',
        'isbn',
        'published_year',
    ];

    protected function casts(): array
    {
        return [
            'published_year' => 'integer',
        ];
    }

    public function location(): HasOne
    {
        return $this->hasOne(PhysicalLocation::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }
}
