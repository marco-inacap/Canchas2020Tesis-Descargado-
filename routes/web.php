<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    }

    /* DB::listen(function($query){
            var_dump($query->sql);
    }); */

    /* Route::get('email',function(){
            return new  App\Mail\LoginCredentials(App\User::first(),'asd123');
    }); */

    
                //Rutas Google
                
        Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
        Route::get('/callback/{provider}', 'SocialController@callback');


        //grupo para filtrar Login entre usuario  Admin y Cliente para ingresar al panel del administrador
        Route::group([
                'prefix' => 'admin',    
                'namespace' =>  'Admin',   
                'middleware'   => 'auth',
                'middleware' => ['role:Admin|Dueño']], 
        function(){
                
                Route::get('/', 'AdminController@index')->name('dashboard');
        

        });

        





        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); 


        Route::get('login/user', 'Auth\LoginUserController@showLoginFormUser')->name('loginuser');

        Route::post('login', 'Auth\LoginController@login');
        Route::post('login', 'Auth\LoginUserController@login')->name('logg');

        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('users.register');
        Route::post('register', 'Auth\RegisterController@register');
        
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/', 'PagesController@home')->name('pages.home');  

/*  Route::get('/', 'PagesController@spa')->name('pages.home');  */

Route::get('contacto', 'PagesController@contacto')->name('pages.contacto');


Route::get('/inicio/{cancha}', 'CanchaController@show')->name('canchas.show');
Route::get('/complejos/{complejo}', 'ComplejoController@show')->name('complejos.show');
Route::get('/complejos/inicio/{cancha}', 'CanchaController@show')->name('canchas.show');







Route::group(['middleware' => 'auth'], function () {
        Route::get('/complejos/inicio/{cancha}/reserva', 'ReservaCanchaController@index')->name('reservar.cancha');
        
        Route::get('/reservas/{cancha}/listar', 'ReservaCanchaController@listar');
        Route::get('/horarios/{cancha}/horarioCierre', 'ReservaCanchaController@horarioCierre');

        Route::post('/reserva/{cancha}/reservar','ReservaCanchaController@store')->name('reservar.guardar');
        Route::delete('reservas/{reserva}','ReservaCanchaController@destroy');

        Route::get('misreservas', 'PagesController@reservas')->name('pages.misreservas');

        Route::resource('canchas', 'CanchaController');

        Route::get('canchas/{cancha}/like', 'CanchaController@like')->name('canchas.like');
        Route::get('canchas/{cancha}/unlike', 'CanchaController@unlike')->name('canchas.unlike');

        Route::get('canchas/{cancha}/dislike', 'CanchaController@dislike')->name('canchas.dislike');
        Route::get('canchas/{cancha}/undislike', 'CanchaController@undislike')->name('canchas.undislike');

        Route::get('/complejos/inicio/{cancha}/reserva/index', 'ReservaCanchaController@init_webpay')->name('pago.index');  
        Route::post('/webpayplus/return/', 'ReservaCanchaController@return_webpay')->name('webpay.return');
        Route::post('/webpayplus/final/', 'ReservaCanchaController@final')->name('webpay.final');
});









Route::group([
                'prefix' => 'admin',    
                'namespace' =>  'Admin',   
                'middleware'   => 'auth'], 
        function(){
                //el prefijo es para no tener que estar agregando el admin/canchas || lo mismo con el controlador namespace
                /* Route::get('/', 'AdminController@index')->name('dashboard'); */

                /* Route::resource('canchas','CanchaController',['except' =>'show','as' => 'admin']); */
                Route::resource('users','UsersController',['as' => 'admin']); 
                Route::resource('roles','RolesController',['except' => 'show','as' => 'admin']);
                Route::resource('permissions','PermissionsController',['only' => ['index','edit','update'],'as' => 'admin']);    
                

                Route::middleware('role:Admin')->put('users/{user}/roles','UsersRolesController@update')->name('admin.users.roles.update');
                Route::middleware('role:Admin')->put('users/{user}/permissions','UsersPermissionsController@update')->name('admin.users.permissions.update');
                
                 Route::resource('horarios','HorariosController',['only' => ['index','create','edit','update','store'],'as' => 'admin']); 

                /* Route::get('horarios','HorariosController@index')->name('admin.horarios.index');
                Route::get('horarios/create','HorariosController@create')->name('admin.horarios.create');
                Route::get('horarios','HorariosController@store')->name('admin.horarios.store'); */

                Route::get('canchas','CanchaController@index')->name('admin.cancha.index');
                Route::get('canchas/create','CanchaController@create')->name('admin.cancha.create');
                Route::post('canchas','CanchaController@store')->name('admin.cancha.store');
                Route::get('canchas/{cancha}','CanchaController@edit')->name('admin.cancha.edit');
                Route::put('canchas/{cancha}','CanchaController@update')->name('admin.cancha.update');
                Route::delete('canchas/{cancha}', 'CanchaController@destroy' )->name('admin.canchas.destroy');  
                 
                Route::post('canchas/{cancha}/photos','PhotoController@store')->name('admin.cancha.photos.store');
                Route::delete('photos/{photo}', 'PhotoController@destroy' )->name('admin.photos.destroy');

                //complejos
                Route::get('complejos','ComplejoController@index')->name('admin.complejo.index');
                Route::get('complejos/create','ComplejoController@create')->name('admin.complejo.create');
                Route::post('complejos','ComplejoController@store')->name('admin.complejo.store');
                Route::get('complejos/{complejo}','ComplejoController@edit')->name('admin.complejo.edit');
                Route::put('complejos/{complejo}','ComplejoController@update')->name('admin.complejo.update');
                Route::delete('complejos/{complejo}', 'ComplejoController@destroy' )->name('admin.complejo.destroy');

                //ganancias
                Route::get('ganancias','GananciasController@index')->name('admin.ganancias.index');
                Route::get('ganancias/{complejo}','GananciasController@ganancias_canchas')->name('admin.ganancias.canchas');
                Route::get('canchas/ganancias/{cancha}','GananciasController@lista_reservas')->name('admin.ganancias.lista');

                //ajax
                Route::post('/ganancias/all','GananciasController@all');

           
});

/* Route::get('/reserva/{id_cancha}/ambiente/{mes}/mes', 'ReservaController@reservasByCancha');

//reservasByAmbiente

Route::resource('/reserva','ReservaController'); 





Route::any('prueba','ReservaController@enviarNotificacion' );  */




        






 
//Route::get('/home', 'HomeController@index')->name('home');
