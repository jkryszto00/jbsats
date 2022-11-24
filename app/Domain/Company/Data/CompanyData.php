<?php declare(strict_types=1);

namespace App\Domain\Company\Data;

use App\Domain\Company\Enums\CompanyStatus;
use App\Domain\Company\Models\Company;
use App\Domain\User\Data\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CompanyData extends Data
{
    public function __construct(
        public readonly int|Optional $id,
        public readonly UserData|Optional $owner,
        public readonly string|Optional $logo,
        public readonly string $name,
        public readonly string $description,
        public readonly int $founded,
        public readonly string $size,
        public readonly string $industry,
        public readonly string $city,
        public readonly string $country,
        public readonly CompanyStatus|Optional $status
    ) {}

    public static function fromModel(Company $company): self
    {
        return self::from([
            ...$company->toArray(),
            'logo' => $company->logo
        ]);
    }
}
