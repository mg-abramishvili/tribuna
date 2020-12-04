<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'id' => '1',
                'title' => 'Текст',
            ],
            [
                'id' => '2',
                'title' => 'Логотип',
            ],
            [
                'id' => '3',
                'title' => 'Картинка',
            ],
            [
                'id' => '4',
                'title' => 'Видео',
            ],
            ]);
    }
}
