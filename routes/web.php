<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('articles', function(){
    $articles = ['Article B', 'Article A', 'Article C'];

    $sort = request()->query('sort', null);

    switch ($sort) {
        case 'desc':
           rsort($articles);
            break;
        
         case 'asc':
            sort($articles);   
        
        
        default:
           sort($articles);
            break;
    }


    foreach($articles as $article){
        echo '<p>'.$article.'</p>';
    }
});

Route::get('test/{username}', function($username){
    echo'Bonjour ' .$username;
});

Route::get('profile/{name?}', function($name = null){
    if($name){
        echo 'Bonjour ' .$name;
    }
    else{
        echo 'Bonjour inconnu.';
    }
});
