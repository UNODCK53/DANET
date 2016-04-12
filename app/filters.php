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

//Filtros tierras
Route::filter('consulgentierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1101")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('reporestadotierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1201")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('repornumtierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1202")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('reporlevtopotierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1203")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('reporarealevtierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1204")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('consulresjuritierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1205")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('reporgenero', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1206")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('cargainicialtierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1301")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('procesosadjudicadostierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1302")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('levgeograficotierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1304")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('editcoortierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1305")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});

Route::filter('consmapfierras', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="1306")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
//Finaliza filtros tierras
//--------------------------------------------------------------------------------------------------------------------------
//Fitros módulo de GME
Route::filter('valcertGME', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="2101")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('metodologiaGME', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="2102")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('distGME', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="2103")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('informesGME', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="2104")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
//Finaliza fitros módulo de GME
//--------------------------------------------------------------------------------------------------------------------------
//Inicia filtros módulo SISCADI
Route::filter('ConsencSISCADI', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="3101")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('indicarecoSISCADI', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="3102")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
//Finaliza filtros módulo SISCADI
//--------------------------------------------------------------------------------------------------------------------------
//Inicia filtros módulo Documentos
Route::filter('cargueDOCUMENTOS', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="4101")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('consulDOCUMENTOS', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="4102")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('reporDOCUMENTOS', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="4103")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
//Finaliza filtros módulo Documentos
//--------------------------------------------------------------------------------------------------------------------------
//Inicia filtros módulo Geoapi
Route::filter('tecsafGEOAPI', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="5101")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
Route::filter('repordistorgGEOAPI', function ()
{
   $acc=(Session::get('acc'));
   $p=0;
   foreach ($acc as $acceso) {
      if(($acceso->id_vista=="5105")&&($acceso->acces=="1")){
         $p=1;
      }
   }   
   if($p==0){
      return Redirect::to('principal');
   }
});
//Finaliza filtros módulo Geoapi
//--------------------------------------------------------------------------------------------------------------------------
Route::filter('grupo1',function()
{
   $grupo=Auth::user()->grupo;
   if($grupo!=1){
      return Redirect::to('principal');
   }
});
Route::filter('level1',function()
{
   $level=Auth::user()->level;
   if($level!=1){
      return Redirect::to('principal');
   }
});
