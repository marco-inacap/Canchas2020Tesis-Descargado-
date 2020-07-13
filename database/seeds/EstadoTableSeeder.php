<?php

use Illuminate\Database\Seeder;
use App\Estado;
use App\EstadoReserva;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::truncate(); // Evita duplicar datos

        $estado = new Estado();
        $estado->nombre = "OCUPADA";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "DISPONIBLE";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "EN MANTENCIÓN";
        $estado->save();


        EstadoReserva::truncate(); // Evita duplicar datos

        $estadoReserva = new EstadoReserva();
        $estadoReserva->nombre = "PENDIENTE";
        $estadoReserva->save();

        $estadoReserva = new EstadoReserva();
        $estadoReserva->nombre = "FINALIZADA";
        $estadoReserva->save();

        $estadoReserva = new EstadoReserva();
        $estadoReserva->nombre = "RECHAZADA";
        $estadoReserva->save();
    }
    
}
