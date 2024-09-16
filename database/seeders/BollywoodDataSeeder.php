<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BollywoodDataSeeder extends Seeder
{
    public function run()
    {
        // Actresses
        $actresses = [
            ['name' => 'Deepika Padukone', 'bio' => 'Known for her roles in Padmaavat and Chennai Express.', 'image_url' => 'https://example.com/deepika.jpg'],
            ['name' => 'Alia Bhatt', 'bio' => 'Starred in critically acclaimed films like Highway and Raazi.', 'image_url' => 'https://example.com/alia.jpg'],
            ['name' => 'Priyanka Chopra', 'bio' => 'Bollywood star who made it big in Hollywood.', 'image_url' => 'https://example.com/priyanka.jpg'],
            ['name' => 'Kangana Ranaut', 'bio' => 'Known for her bold roles and outspoken personality.', 'image_url' => 'https://example.com/kangana.jpg'],
            ['name' => 'Vidya Balan', 'bio' => 'Versatile actress known for women-centric films.', 'image_url' => 'https://example.com/vidya.jpg'],
        ];

        DB::table('actresses')->insert($actresses);

        // Polls
        $polls = [
            ['title' => 'Best Actress of 2023', 'category' => 'Annual Awards', 'is_featured' => true, 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays(30)],
            ['title' => 'Most Stylish Actress', 'category' => 'Fashion', 'is_featured' => false, 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays(15)],
            ['title' => 'Best Debut Performance', 'category' => 'Newcomers', 'is_featured' => true, 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays(45)],
        ];

        DB::table('polls')->insert($polls);

        // Poll Options
        $pollOptions = [
            ['poll_id' => 1, 'actress_id' => 1, 'votes' => 1000],
            ['poll_id' => 1, 'actress_id' => 2, 'votes' => 1200],
            ['poll_id' => 1, 'actress_id' => 3, 'votes' => 800],
            ['poll_id' => 2, 'actress_id' => 1, 'votes' => 500],
            ['poll_id' => 2, 'actress_id' => 4, 'votes' => 600],
            ['poll_id' => 3, 'actress_id' => 5, 'votes' => 300],
        ];

        DB::table('poll_options')->insert($pollOptions);
    }
}
