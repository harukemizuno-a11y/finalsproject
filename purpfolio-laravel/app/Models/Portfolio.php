
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'name',
        'headline',
        'bio',
        'email',
        'location',
        'avatar',
        'skills',
        'projects',
        'socials',
        'template',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'projects' => 'array',
            'socials' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
