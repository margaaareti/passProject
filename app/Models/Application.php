<?php

namespace App\Models;

use App\Models\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'application_number',
        'application_type',
        'applicationable_type',
        'applicationable_id',
        'status', 'approved_by',
        'signed_by',
        'start_date', 'end_date',
        'object', 'purpose',
        'contract_number',
        'equipment',
        'phone_number',
        'responsible_person',
        'approved_by',
        'viewed'
    ];

    protected $casts = [
        'status' => ApplicationStatusEnum::class,
    ];

    public function applicationable():MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

}
