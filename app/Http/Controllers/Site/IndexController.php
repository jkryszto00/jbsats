<?php

namespace App\Http\Controllers\Site;

use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\CategoryResource;
use App\Domain\JobOffer\Resources\JobOfferResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = CategoryResource::collection(Category::all());
        $levels = array_map(fn (JobOfferLevel $level) => [
            'name' => $level->text(),
            'value' => $level->value
        ], JobOfferLevel::cases());
        $types = ContractType::cases();

        $filters = [
            'title' => $request->get('title') ? $request->get('title') : null,
            'category' => $request->get('category') ? explode(',', $request->get('category')): null,
            'level' => $request->get('level') ? explode(',', $request->get('level')) : null,
            'contract' => $request->get('contract') ? explode(',', $request->get('contract')) : null
        ];

        $jobOffers = JobOfferResource::collection(JobOffer::with('company', 'categories')->filter($filters)->get());

        return inertia('Site/Index', [
            'categories' => $categories,
            'levels' => $levels,
            'contracts' => $types,
            'jobOffers' => $jobOffers,
        ]);
    }
}
