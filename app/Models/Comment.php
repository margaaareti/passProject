<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_to_admin_comment',
        'admin_to_user_comment',
        'user_to_admin_comment',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
