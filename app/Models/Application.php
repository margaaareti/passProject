<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Application extends Model
{
    public function applicationable():MorphTo
    {
        return $this->morphTo();
    }
}
