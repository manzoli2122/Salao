<?php

Route::group([
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('logout', 'Auth\AuthApiController@logout');
    Route::post('refresh', 'Auth\AuthApiController@refresh');
    Route::post('me', 'Auth\AuthApiController@me');

});



$this->group([ 'middleware' => 'auth:api', 'prefix' => 'v1'], function(){
    
    Route::resource('servicos', 'ServicoController', ['only' => [
            'index', 'show' 
        ] ,
        'names' => [                
            'index' => 'servicos.api.index' ,   
            'show' => 'servicos.api.show' ,
        ]
    ]);

});