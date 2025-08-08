<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'company_id' => 1,
                'title' => 'Senior PHP Developer',
                'description' => 'Develop and maintain web applications using PHP frameworks. Collaborate with team members on innovative projects.',
                'type' => 'full-time',
                'salary' => 90.000
            ],
            [
                'company_id' => 2,
                'title' => 'Frontend Engineer',
                'description' => 'Build responsive user interfaces using React.js and modern CSS. Work closely with designers and backend developers.',
                'type' => 'full-time',
                'salary' => 85.0
            ],
            [
                'company_id' => 3,
                'title' => 'DevOps Specialist',
                'description' => 'Implement CI/CD pipelines and manage cloud infrastructure. Optimize deployment processes and monitoring systems.',
                'type' => 'contract',
                'salary' => 70
            ],
            [
                'company_id' => 1,
                'title' => 'Junior Web Developer',
                'description' => 'Assist in developing and testing web applications. Learn from senior developers and grow your skills.',
                'type' => 'part-time',
                'salary' => 25 
            ],
            [
                'company_id' => 4,
                'title' => 'Data Scientist',
                'description' => 'Analyze large datasets and build machine learning models. Present findings to stakeholders and product teams.',
                'type' => 'full-time',
                'salary' => 110
            
            ],
            [
                'company_id' => 5,
                'title' => 'UX Designer',
                'description' => 'Create user-centered designs and prototypes. Conduct user research and usability testing.',
                'type' => 'full-time',
                'salary' => 80
            ],
            [
                'company_id' => 2,
                'title' => 'Technical Writer',
                'description' => 'Create documentation for APIs and developer tools. Work with engineering teams to explain complex concepts clearly.',
                'type' => 'part-time',
                'salary' => 45
            ],
            [
                'company_id' => 6,
                'title' => 'Mobile App Developer',
                'description' => 'Build and maintain iOS/Android applications using Flutter. Implement new features and optimize performance.',
                'type' => 'full-time',
                'salary' => 125
                
            ],
            [
                'company_id' => 3,
                'title' => 'Database Administrator',
                'description' => 'Manage and optimize database systems. Ensure data security and implement backup solutions.',
                'type' => 'contract',
                'salary' => 80
            ],
            [
                'company_id' => 7,
                'title' => 'Customer Support Specialist',
                'description' => 'Assist customers with technical issues. Document common problems and solutions for knowledge base.',
                'type' => 'part-time',
                'salary' => 20
            ]
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
