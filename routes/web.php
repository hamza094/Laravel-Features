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


Route::get('/',[
   'uses'=>'FrontController@welcome',
    'as'=>'welcome'
]);

Route::get('/shop',[
   'uses'=>'ProductController@shop',
    'as'=>'shop'
]);

Route::get('/category', function () {
    return view('categories');
});

Route::get('/tag',function(){
    return view('tags');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/activation/{token}','Auth\RegisterController@userActivation');

Route::middleware('ajax.check')->group(function(){
    
    Route::resource('categories','CategoriesController');
    
    Route::get('categories/edit/{id}','CategoriesController@edit');
    
    Route::post('categories/update','CategoriesController@update');
    
   // Route::put('comments/update','CommentController@update')->name('formSubmit');
        
    Route::get('categories/delete/{id}','CategoriesController@destroy');
    
    Route::get('categories/search','CategoriesController@search');
    
    Route::resource('tags','TagsController');
    
    Route::get('tags/edit/{id}','TagsController@edit');
    
    Route::post('tags/update','TagsController@update');
    
    Route::get('tags/destroy/{id}','TagsController@destroy');
    
    Route::get('comments/edit/{id}','CommentController@cmntedit');
    
     Route::get('/comment/like/{id}',[
   'uses'=>'CommentController@like',
    'as'=>'comment.like'
]);

Route::get('/comment/unlike/{id}',[
   'uses'=>'CommentController@unlike',
    'as'=>'comment.unlike'
]);

});

Route::group(['prefix'=>'admin_@ccess'],function(){
    Route::resource('articles','ArticleController');


Route::resource('articles','ArticleController');

Route::get('articles/trash/{id}',[
    'uses'=>'ArticleController@trash',
    'as'=>'articles.trash'
]);

Route::get('trashed/article',[
   'uses'=>'ArticleController@trashed',
    'as'=>'trash.view'
]);

Route::get('articles/revert/{id}',[
    'uses'=>'ArticleController@revert',
    'as'=>'articles.revert'
]);

Route::get('delete/article/{id}',[
     'uses'=>'ArticleController@destroy',
    'as'=>'articles.destroy'
]);
    
Route::get('users',[
    'uses'=>'UsersController@index',
    'as'=>'users.index'
]);
    
Route::resource('products','ProductController');    
    
Route::get('/orders',[
   'uses'=>'ProductController@order',
    'as'=>'order'
]);    
Route::get('deliver/{id}',[
    'uses'=>'ProductController@deliver',
    'as'=>'order.deliver'
]);
    
});

Route::resource('review','PorductReviewController');   

Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

Route::resource('users','UsersController');

Route::get('users/admin/{id}',[
   'uses'=>'UsersController@admin',
    'as'=>'admin.make'
]);

Route::get('users/unadmin/{id}',[
   'uses'=>'UsersController@unadmin',
    'as'=>'admin.not'
]);

Route::get('article/{slug}',[
    'uses'=>'FrontController@show',
    'as'=>'articles.slug'
]);

Route::get('article/category/{id}',[
    'uses'=>'FrontController@catshow',
    'as'=>'article.category'
]);

Route::get('article/user/{id}',[
    'uses'=>'FrontController@usershow',
    'as'=>'article.user'
]);


Route::post('article/comment/{id}',[
    'uses'=>'FrontController@comment',
    'as'=>'article.comment'
]);

Route::get('article/subscribe/{id}',[
   'uses'=>'FrontController@subscribe',
    'as'=>'article.subscribe'
]);

Route::get('article/unsubscribe/{id}',[
   'uses'=>'FrontController@unsubscribe',
    'as'=>'article.unsubscribe'
]);

Route::post('/subscribe',function(){
    $email=request("email");
    Newsletter::subscribe($email);
    
    Session::flash('success','You Subscribe Our Newsletter');
    return redirect()->back();
});

Route::get('/articles/search',[
    'uses'=>'FrontController@search',
      'as'=>'article.search'
]);

Route::get('product/category/{id}',[
    'uses'=>'ProductController@pdtcat',
    'as'=>'product.category'
]);

//cart
Route::post('/cart/add',[
   'uses'=>'ShopController@addcart',
    'as'=>'add.cart'
]);

Route::get('/cart',[
    'uses'=>'ShopController@cart',
    'as'=>'cart'
]);

Route::get('/cart/delete/{id}',[
     'uses'=>'ShopController@cartdelete',
    'as'=>'cart.delete'
]);

Route::get('/cart/reduce/{id}/{qty}',[
     'uses'=>'ShopController@cartreduce',
    'as'=>'cart.reduce'
]);

Route::get('/cart/incr/{id}/{qty}',[
     'uses'=>'ShopController@cartincr',
    'as'=>'cart.incr'
]);

Route::post('/cart/checkout',[
     'uses'=>'ShopController@checkout',
    'as'=>'cart.checkout'
]);
Route::get('/product/search',[
   'uses'=>'ProductController@search',
    'as'=>'product.search'
]);
Route::get('/payment/checkout',[
    'uses'=>'ShopController@paymentcheckout',
    'as'=>'checkout',
]);
Route::get('/cancel/order',[
     'uses'=>'ShopController@ordercancel',
    'as'=>'order.cancel',
]);
Route::get('/subscribe','SubscribeController@index');

Route::get('pay/{plan}','SubscribeController@pay')->name('pay');
Route::post('pay/{plan}','SubscribeController@pay');

Route::get('cancel','SubscribeController@cancel');

Route::get('user/invoice/{invoice}','SubscribeController@invoice');

Route::patch('/update/{id}','CommentController@update');

Route::delete('/delete/{id}','CommentController@destroy');