<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => "Notebook A315-58-573p I5 8gb 256gb Ssd 15,6'' Cinza Acer",
                'price' => 2795
            ],
            [
                'name' =>  'Notebook Samsung Intel Celeron-6305 Np550xda-kp3br',
                'price' => 2167
            ],
            [
                'name' =>  'Monitor gamer LG 24MK430H led 23.8" preto 100V/240V',
                'price' => 799
            ],
            [
                'name' =>  'Fone de ouvido in-ear sem fio QCY T1C preto',
                'price' => 105.30
            ],
            [
                'name' =>  'Suporte ELG F80N de mesa para TV/Monitor de 17" até 35" preto',
                'price' => 201.57
            ],
            [
                'name' =>  'Apple iPad (9ª geração) 10.2" Wi-Fi 64GB - Cinza-espacial',
                'price' => 251
            ],
        ]);
    }
}
