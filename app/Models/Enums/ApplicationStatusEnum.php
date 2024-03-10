<?php

namespace App\Models\Enums;

enum ApplicationStatusEnum: string
{
case pending = 'pending';
case cancelled = 'cancelled';
case approved = 'approved';
case new = 'new';

    public function name(): string
    {
        return match ($this) {
            self::approved => 'Одобрено',
            self::pending => 'Ожидание',
            self::cancelled => 'Отклонено',
            self::new => 'Новая заявка',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::approved => 'success',
            self::pending => 'warning',
            self::cancelled => 'danger',
            self::new => '',
        };
    }

    public function is(ApplicationStatusEnum $status): bool
    {
        return $this === $status;

    }

    public function isPending(): bool
    {
        return $this->is(ApplicationStatusEnum::pending);

    }

    public function isApproved(): bool
    {
        return $this->is(ApplicationStatusEnum::approved);

    }

    public function isCanceled(): bool
    {
        return $this->is(ApplicationStatusEnum::cancelled);

    }

    public function isNew(): bool
    {
        return $this->is(ApplicationStatusEnum::new);

    }


}
