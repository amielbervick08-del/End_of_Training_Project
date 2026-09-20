<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            [
                'name' => 'JavaScript',
                'category' => 'Programming',
                'description' => 'Learn JavaScript programming and web development.',
            ],
            [
                'name' => 'PHP',
                'category' => 'Programming',
                'description' => 'Learn PHP programming and backend web development.',
            ],
            [
                'name' => 'Laravel',
                'category' => 'Programming',
                'description' => 'Learn Laravel framework development.',
            ],
            [
                'name' => 'Python',
                'category' => 'Programming',
                'description' => 'Learn Python programming and development.',
            ],
            [
                'name' => 'HTML',
                'category' => 'Web Development',
                'description' => 'Learn the fundamentals of HTML and web page structure.',
            ],
            [
                'name' => 'CSS',
                'category' => 'Web Development',
                'description' => 'Learn CSS styling and responsive web design.',
            ],
            [
                'name' => 'Graphic Design',
                'category' => 'Design',
                'description' => 'Learn graphic design principles and techniques.',
            ],
            [
                'name' => 'UI/UX Design',
                'category' => 'Design',
                'description' => 'Learn user interface and user experience design.',
            ],
            [
                'name' => 'Photography',
                'category' => 'Creative',
                'description' => 'Learn photography techniques and composition.',
            ],
            [
                'name' => 'Video Editing',
                'category' => 'Creative',
                'description' => 'Learn video editing and production techniques.',
            ],
            [
                'name' => 'English',
                'category' => 'Languages',
                'description' => 'Improve English communication and language skills.',
            ],
            [
                'name' => 'French',
                'category' => 'Languages',
                'description' => 'Improve French communication and language skills.',
            ],
            [
                'name' => 'Mathematics',
                'category' => 'Academic',
                'description' => 'Learn mathematics and problem-solving skills.',
            ],
            [
                'name' => 'Public Speaking',
                'category' => 'Communication',
                'description' => 'Improve public speaking and presentation skills.',
            ],
            [
                'name' => 'Digital Marketing',
                'category' => 'Business',
                'description' => 'Learn digital marketing strategies and techniques.',
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}