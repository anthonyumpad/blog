<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes as SoftDeletes;
use Jenssegers\Mongodb\Eloquent;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Relations\HasMany;

class User extends CartalystUser
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $dates      = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return Jenssegers\Mongodb\Relations\HasMany;
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

}
