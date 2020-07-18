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
        $complejo->latitude = "-40.568803";
        $complejo->longitude = "-73.1423372";
        $complejo->telefono = "123456789";
        $complejo->save();

        $complejo = new Complejo();
        $complejo->nombre = "Canchas Matices";
        $complejo->ubicacion = "Osorno";
        $complejo->latitude = "-40.5708959";
        $complejo->longitude = "-73.1551774";
        $complejo->telefono = "123456789";
        $complejo->save();

        $complejo = new Complejo();
        $complejo->nombre = "Canchas Real";
        $complejo->ubicacion = "Osorno";
        $complejo->latitude = "-40.5707995";
        $complejo->longitude = "-73.1550085";
        $complejo->telefono = "123456789";
        $complejo->save();

    }
}
