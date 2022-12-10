<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        DB::table('cities')->insert([
            [
                'name' => 'Pedreira',
                'uf' => 'São Paulo',
                'group_id' => 1
            ],
            [
                'name' => 'Campinas',
                'uf' => 'São Paulo',
                'group_id' => 1
            ],
            [
                'name' => 'Jaguariuna',
                'uf' => 'São Paulo',
                'group_id' => 1
            ],
            [
                'name' => 'Amparo',
                'uf' => 'São Paulo',
                'group_id' => 1
            ],
            [
                'name' => 'Mogi Mirim',
                'uf' => 'São Paulo',
                'group_id' => 2
            ],
            [
                'name' => 'Mogi Guaçu',
                'uf' => 'São Paulo',
                'group_id' => 2
            ],
            [
                'name' => 'Americana',
                'uf' => 'São Paulo',
                'group_id' => 2
            ],
            [
                'name' => 'Bragança',
                'uf' => 'São Paulo',
                'group_id' => 2
            ]
        ]);
    
    }
}
