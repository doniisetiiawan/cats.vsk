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

Route::get('cats/{id}', function ($id) {
    $cat = \App\Cat::find($id);
    return view('cats.single')
        ->with('cat', $cat);
})->where('id', '[0-9]+');

Route::middleware('auth')->group(function () {
    Route::get('cats/create', function () {
        $cat = new \App\Cat();
        return view('cats.edit')
            ->with('cat', $cat)
            ->with('method', 'post');
    });

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

    Route::post('cats', function () {
        $cat          = \App\Cat::create(InputAlias::all());
        $cat->user_id = Auth::user()->id;
        if ($cat->save()) {
            return Redirect::to('cats/' . $cat->id)
                ->with('message', 'Successfully created profile!');
        } else {
            return Redirect::back()
                ->with('error', 'Could not create profile');
        }
    });

    Route::put('cats/{cat}', function (\App\Cat $cat) {
        if (Auth::user()->canEdit($cat)) {
            $cat->update(InputAlias::all());
            return Redirect::to('cats/' . $cat->id)
                ->with('message', 'Successfully updated profile!');
        } else {
            return Redirect::to('cats/' . $cat->id)
                ->with('error', "Unauthorized operation");
        }
    });

    Route::delete('cats/{cat}', function (\App\Cat $cat) {
        $cat->delete();
        return Redirect::to('cats')
            ->with('message', 'Successfully deleted page!');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('json-test', function () {
    return \App\Cat::paginate(2);
});
