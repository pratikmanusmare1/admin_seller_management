<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create(['name' => 'PHP']);
        Skill::create(['name' => 'Laravel']);
        Skill::create(['name' => 'JavaScript']);
        Skill::create(['name' => 'React']);
        Skill::create(['name' => 'Vue.js']);
        Skill::create(['name' => 'MySQL']);
        Skill::create(['name' => 'HTML/CSS']);
        Skill::create(['name' => 'Python']);
        Skill::create(['name' => 'Java']);
        Skill::create(['name' => 'Node.js']);
    }
}
