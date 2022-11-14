<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyJobOfferController extends Controller
{
    public function __invoke(Request $request)
    {
        dd($request->all());
    }
}
