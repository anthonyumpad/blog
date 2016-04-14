<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes as SoftDeletes;
use Jenssegers\Mongodb\Eloquent;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends CartalystUser
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'users_collection';
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
