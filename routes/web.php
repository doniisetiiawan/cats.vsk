<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

use Illuminate\Support\Facades\Input as InputAlias;

Route::get('/', function () {
    return Redirect::to('cats');
});

Route::get('about', function () {
    return view('about')->with('number_of_cats', 9000);
});

Route::get('cats', function () {
    $cats = \App\Cat::all();
    return view('cats.index')
        ->with('cats', $cats);
});;

Route::get('cats/breeds/{name}', function ($name) {
    $breed = \App\Breed::whereName($name)->with('cats')->first();
    return view('cats/index')
        ->with('breed', $breed)
        ->with('cats', $breed->cats);
});

Route::get('cats/create', function () {
    $cat = new \App\Cat();
    return view('cats.edit')
        ->with('cat', $cat)
        ->with('method', 'post');
});

Route::post('cats', function () {
    $cat = \App\Cat::create(InputAlias::all());
    return Redirect::to('cats/' . $cat->id)
        ->with('message', 'Successfully created page!');
});

Route::get('cats/{id}', function ($id) {
    $cat = \App\Cat::find($id);
    return view('cats.single')
        ->with('cat', $cat);
});;

Route::get('cats/{cat}/edit', function (\App\Cat $cat) {
    return view('cats.edit')
        ->with('cat', $cat)
        ->with('method', 'put');
});

Route::get('cats/{cat}/delete', function (\App\Cat $cat) {
    return view('cats.edit')
        ->with('cat', $cat)
        ->with('method', 'delete');
});

Route::put('cats/{cat}', function (\App\Cat $cat) {
    $cat->update(InputAlias::all());
    return Redirect::to('cats/' . $cat->id)
        ->with('message', 'Successfully updated page!');
});

Route::delete('cats/{cat}', function (\App\Cat $cat) {
    $cat->delete();
    return Redirect::to('cats')
        ->with('message', 'Successfully deleted page!');
});
