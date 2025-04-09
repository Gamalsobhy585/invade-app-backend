<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['en_name' => 'Home','ar_name'=> 'منزل', ],
            ['en_name' => 'Work','ar_name'=> 'عمل', ],
            ['en_name' => 'Personal','ar_name'=> 'شخصي', ],
            ['en_name' => 'Friends','ar_name'=> 'أصدقاء', ],
            ['en_name' => 'Relatives','ar_name'=> 'أقارب', ],
            ['en_name' => 'School','ar_name'=> 'مدرسة', ],
            ['en_name' => 'University','ar_name'=> 'جامعة', ],
            ['en_name' => 'Business','ar_name'=> 'بيزنس', ],
            ['en_name' => 'Sport','ar_name'=> 'رياضة', ],
            ['en_name' => 'Fun & Enjoyment','ar_name'=> 'متعة و تسلية', ],
            ['en_name' => 'other','ar_name'=> 'أخرى', ],
           
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
