<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ['as' => 'home', function () use ($router) {
    return $router->app->version();
}]);

$router->get('/named', function () use ($router) {
    return redirect()->route('home');
});

$router->get('/test', function () use ($router) {
    $json = [
        'status' => true,
        'message' => 'Test is success'
    ];

    return response()->json($json, 200);
});

$router->get('user/{nama}/{usia}/alamat/{kota}/{negara}', function ($nama, $usia, $kota, $negara) {
    $json = [
        'nama' => $nama,
        'usia' => $usia,
        'alamat' =>
        [
            'kota' => $kota,
            'negara' => $negara
        ]
    ];

    return response()->json($json, 200);
});

$router->get('mahasiswa', 'MahasiswaController@index');
$router->get('mahasiswa/{nim}', 'MahasiswaController@show');
$router->post('mahasiswa/store', 'MahasiswaController@store');
$router->put('mahasiswa/update/{nim}', 'MahasiswaController@update');
$router->delete('mahasiswa/destroy/{nim}', 'MahasiswaController@destroy');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/dosen', 'DosenController@index');
    $router->get('/dosen/{nid}', 'DosenController@show');
    $router->post('/dosen/store', 'DosenController@store');
    $router->put('/dosen/update/{nid}', 'DosenController@update');
    $router->delete('/dosen/destroy/{nid}', 'DosenController@destroy');
});
