<?php

namespace Database\Seeders;

use App\Domain\JobOffer\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Creative', 'Gaming', 'Marketing', 'HR', 'PR', 'Finance', 'Business', 'Management', 'Sales', 'Analysis', 'Security', 'Engineering'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
