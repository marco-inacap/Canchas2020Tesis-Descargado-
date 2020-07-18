<?php

namespace App\Http\Controllers\Api;

use App\Complejo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Complejo as ComplejoResource;

class ComplejoController extends Controller
{
    public function index()
    {
        $complejos = Complejo::all();

        $geoJSONdata = $complejos->map(function ($complejo) {
            return [
                'type'       => 'Feature',
                'properties' => new ComplejoResource($complejo),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $complejo->longitude,
                        $complejo->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
