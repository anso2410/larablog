<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArticleController, 
    UserController,
    RegisterController,
    LoginController,
    LogoutController,
    ForgotController,
    ResetController,
    CommentController
};

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

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('forgot', [ForgotController::class, 'index'])->name('forgot');
Route::get('reset/{token}', [ResetController::class, 'index'])->name('reset');
Route::get('user/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('user/password', [UserController::class, 'password'])->name('user.password');
Route::get('profile/{user}', [UserController::class, 'profile'])->name('user.profile');

Route::get('/', [ArticleController::class, 'index'] );


Route::post('password', [UserController::class, 'updatePassword'])->name('update.password');
Route::post('register', [RegisterController::class, 'register'])->name('post.register');
Route::post('login', [LoginController::class, 'login'])->name('post.login');
Route::post('forgot', [ForgotController::class, 'store'])->name('post.forgot');
Route::post('reset', [ResetController::class, 'reset'])->name('post.reset');
Route::post('comment/{article}', [CommentController::class, 'store'])->name('post.comment');
Route::post('user/store', [UserController::class, 'store'])->name('post.user');


Route::resource('articles', ArticleController::class )->except('index');

// Route::get('structures', function(){
    // $fruits = ['pommes', 'oranges', 'mandarines', 'citrons'];
    // $data = [
        // 'number'=>2,
        // 'fruits'=>$fruits,
    // ];
    // return view('structures', $data);
// });

// Route::get('test', function(){
    // return view('test')->withTitle('Laravel');
// });

// Route::get('test2', function(){
    // return view('test2')->withTitle('PHP');
// });


Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');






// Route::get('test', function() {
    // $firstname = request()->query('firstname', null);
    // $lastname = request()->query('lastname', null);
    // $data = [
        // 'title'=>'Page de '.$firstname. ' '.$lastname,
        // 'description'=>'Page de '.$firstname.' '.$lastname,
        // 'firstname'=>$firstname,
        // 'lastname'=>$lastname,
    // ];
    // return view('test.index', $data);
// });

// Route::get('profile/{firstname}/{lastname}', function($firstname = null, $lastname = null){
    // //return view('profile.index')->with('firstname', $firstname)->with('lastname', $lastname);
    // //return view('profile.index')->with(compact('firstname', 'lastname'));
    // //return view('profile.index')->withFirstname($firstname)->withLastname($lastname);
    // $data = [
        // 'title'=>'Mon titre',
        // 'description'=>'Ma super description.',
        // 'firstname'=>$firstname,
        // 'lastname'=>$lastname,
    // ];
    // return view('profile.index', $data);
// });

//Route::get('test', function(){
       // return view('test.index');
 //});

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
