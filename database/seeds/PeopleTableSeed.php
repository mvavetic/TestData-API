<?php
use Illuminate\Database\Seeder;
use App\Models\People;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(People::class, $count)->create()->each(function ($blogPost) {
            $blogPost->make();
        });
    }
}