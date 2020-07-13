<?php

use Illuminate\Database\Seeder;
use App\Complejo;

class ComplejoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complejo::truncate(); // Evita duplicar datos

        $complejo = new Complejo();
        $complejo->nombre = "Osorno Soccer";
        $complejo->ubicacion = "Osorno";
        $complejo->telefono = "123456789";
        $complejo->save();

        $complejo = new Complejo();
        $complejo->nombre = "Canchas Matices";
        $complejo->ubicacion = "Osorno";
        $complejo->telefono = "123456789";
        $complejo->save();

        $complejo = new Complejo();
        $complejo->nombre = "Canchas Real";
        $complejo->ubicacion = "Osorno";
        $complejo->telefono = "123456789";
        $complejo->save();

    }
}
