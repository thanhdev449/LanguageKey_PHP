<?php

use Illuminate\Database\Seeder;
use App\Models\CreatorTable;

class CreatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CreatorTable::class,10)->create();
    }
}
