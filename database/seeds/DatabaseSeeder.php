<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(ComplejoTableSeeder::class);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
