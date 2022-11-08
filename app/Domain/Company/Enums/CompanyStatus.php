<?php declare(strict_types=1);

namespace App\Domain\Company\Enums;

enum CompanyStatus: int
{
    case PUBLISHED = 1;
    case DRAFT = 2;

    public function text(): string
    {
        return match($this) {
            self::PUBLISHED => 'published',
            self::DRAFT => 'draft'
        };
    }
}
