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
    return view('test.index');
});

Route::get('profile/{firstname}/{lastname}', function($firstname = null, $lastname = null){
    return view('profile.index')->with('firstname', $firstname)->with('lastname', $lastname);
});

// Route::get('test', function(){
        // return view('test.index');
// });

// Route::get('articles', function(){
    // $articles = ['Article B', 'Article A', 'Article C'];

    // $sort = request()->query('sort', null);

    // $count = request()->query('count', 5);

    

    // switch ($sort) {
        // case 'desc':
        //    rsort($articles);
            // break;
        
        //  case 'asc':
            // sort($articles);   
        
        
        // default:
        //    sort($articles);
            // break;
    // }


    // foreach($articles as $article){
        // echo '<p>'.$article.'</p>';
    // }
// });

// Route::get('test/{username}', function($username){
    // echo'Bonjour ' .$username;
// });

// Route::get('profile/{name?}', function($name = null){
    // if($name){
        // echo 'Bonjour ' .$name;
    // }
    // else{
        // echo 'Bonjour inconnu.';
    // }
// });
