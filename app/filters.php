<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			//Si no esta autenticado nos redirige a la portada
			return Response::make('portada', 401);
		}
		else
		{
			return Redirect::guest('/');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('cargainicial', function ()
{
   if (Auth::user()->grupo=="1")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="1")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	return Redirect::to('principal');
   	 }
   }
   
   elseif (Auth::user()->grupo=="3")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="1")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	if (Auth::user()->level!="2")
   	 	{
   	//Si no pertenece al level "2" nos envia a principal
   	 		return Redirect::to('principal');
   	 	}
   	 }
   }
   else{
   	return Redirect::to('principal');
   }
});


Route::filter('accesogen', function ()
{
   if (Auth::user()->grupo=="1")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="1")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	return Redirect::to('principal');
   	 }
   }
   
   elseif (Auth::user()->grupo=="3")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="1")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	if (Auth::user()->level!="2")
   	 	{
   	//Si no pertenece al level "2" nos envia a principal
   	 		if (Auth::user()->level!="3")
   	 		{
   	//Si no pertenece al level "2" nos envia a principal
   	 			if (Auth::user()->level!="4")
   	 			{
   	//Si no pertenece al level "2" nos envia a principal
   	 				return Redirect::to('principal');
   	 			}
   	 		}
   	 	}
   	 }
   }
   else{
   	return Redirect::to('principal');
   }
});

Route::filter('levgeografico', function ()
{
   if (Auth::user()->grupo=="1")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="1")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	return Redirect::to('principal');
   	 }
   }
   
   elseif (Auth::user()->grupo=="3")
   {
   	//Si no pertenece al level "1" nos envia a principal
   	 if (Auth::user()->level!="3")
   	 {
   	//Si no pertenece al level "2" nos envia a principal
   	 	return Redirect::to('principal');
   	 }
   }
   else{
   	return Redirect::to('principal');
   }
});
Route::filter('accesogme', function ()
{
   if (Auth::user()->grupo=="1")
   {
      //Si no pertenece al level "1" nos envia a principal
       if (Auth::user()->level!="1")
       {
      //Si no pertenece al level "2" nos envia a principal
         return Redirect::to('principal');
       }
   }
   
   elseif (Auth::user()->grupo=="2")
   {
      //Si no pertenece al level "1" nos envia a principal
       if (Auth::user()->level!="1")
       {
      //Si no pertenece al level "2" nos envia a principal
         if (Auth::user()->level!="2")
         {
      //Si no pertenece al level "2" nos envia a principal
            if (Auth::user()->level!="3")
            {
      //Si no pertenece al level "2" nos envia a principal
               if (Auth::user()->level!="4")
               {
      //Si no pertenece al level "2" nos envia a principal
                  return Redirect::to('principal');
               }
            }
         }
       }
   }
   else{
      return Redirect::to('principal');
   }
});