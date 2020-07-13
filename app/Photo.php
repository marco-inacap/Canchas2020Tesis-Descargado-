<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $guarded = [];

    protected static function boot ()
    {
        parent::boot();

        static::deleting(function($photo){

            $photo = str_replace('storage/' , '' , $photo->url );
            Storage::disk('public')->delete($photo);
              
            /* Storage::disk('public')->delete($photo->url);   */ 

             /* $photoPath = str_replace('storage',  $photo->url); 

        Storage::delete($photoPath); */

        });
        
    }
 
    
}
