<?php

namespace Nickfairchild\NovaBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Nickfairchild\NovaBlog\Traits\HasCategories;

class Post extends Model
{
    use HasCategories;

    protected $casts = [
        'published_at' => 'datetime',
        'data' => 'object'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];
}
