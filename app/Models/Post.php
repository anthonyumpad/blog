<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Eloquent
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'posts';
    protected $fillable   = [
        'user_id',
        'title',
        'category_id',
        'description',
        'tags',
        'content',
        'status'
    ];
    protected $dates      = ['created_at', 'updated_at', 'deleted_at', 'published_at'];

    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';

    /**
     * @return Jenssegers\Mongodb\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
