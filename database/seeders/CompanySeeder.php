<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'user_id' => 6,
                'name' => 'Google',
                'location' => 'Mountain View, California, USA',
                'website' => 'https://www.google.com'
            ],
            [
                'user_id' => 8,
                'name' => 'Microsoft',
                'location' => 'Redmond, Washington, USA',
                'website' => 'https://www.microsoft.com'
            ],
            [
                'user_id' => 3,
                'name' => 'Apple',
                'location' => 'Cupertino, California, USA',
                'website' => 'https://www.apple.com'
            ],
            [
                'user_id' => 3,
                'name' => 'Amazon',
                'location' => 'Seattle, Washington, USA',
                'website' => 'https://www.amazon.com'
            ],
            [
                'user_id' => 8,
                'name' => 'Facebook',
                'location' => 'Menlo Park, California, USA',
                'website' => 'https://www.meta.com'
            ],
            [
                'user_id' => 6,
                'name' => 'Tesla',
                'location' => 'Austin, Texas, USA',
                'website' => 'https://www.tesla.com'
            ],
            [
                'user_id' => 3,
                'name' => 'Netflix',
                'location' => 'Los Gatos, California, USA',
                'website' => 'https://www.netflix.com'
            ],
            [
                'user_id' => 8,
                'name' => 'Twitter',
                'location' => 'San Francisco, California, USA',
                'website' => 'https://twitter.com'
            ],
            [
                'user_id' => 6,
                'name' => 'Uber',
                'location' => 'San Francisco, California, USA',
                'website' => 'https://www.uber.com'
            ],
            [
                'user_id' => 8,
                'name' => 'Airbnb',
                'location' => 'San Francisco, California, USA',
                'website' => 'https://www.airbnb.com'
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
