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
	/* Detect Client Browser Language */
	// Get the request language
	$url_lang = Request::segment(1);
	// Get Cookie Language
	$cookie_lang = Cookie::get('language');
	// Get the browser request language
	$browser_lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0,2);
	// Start checking the request language
	// Check the language the request is support or not?	
	if (!empty($url_lang) AND in_array($url_lang, Config::get('app.available_language'))) {
		// Check whether the request url lang not same as remember in cookie
		if($url_lang != $cookie_lang){
			Session::put('language', $url_lang);
		}
		// Set the App locale
		App::setlocale($url_lang);
	} 
	// Check that has language in forever cookie and is it support or not 
	elseif (!empty($cookie_lang) AND in_array($cookie_lang, Config::get('app.available_language'))) {
		// Set App Locale
		App::setlocale($cookie_lang);
	} 
	// Check the browser request langugae is support in app?
	elseif (!empty($browser_lang) AND in_array($browser_lang, Config::get('app.available_language'))) {
		if ($browser_lang != $cookie_lang) {
			Session::put('language', $browser_lang);
		}
		// Set App Locale
		App::setlocale($browser_lang);
	} else {
		// Default App Setting Language
		App::setlocale(Config::get('app.locale'));
	}
});


App::after(function($request, $response)
{
	$lang = Session::get('language');
	if(!empty($lang))
	{
    	// Send The language Cookies
    	$response->withCookie(Cookie::forever('language',$lang));
	}
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
	if ( Auth::guest() ) // If the user is not logged in
	{
        	return Redirect::guest('user/login');
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
	if (Auth::check()) return Redirect::to('user/login/');
});

/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/

// Check for role on all admin routes
Entrust::routeNeedsRole( 'admin*', array('admin'), Redirect::to('/') );

// Check for permissions on admin actions
Entrust::routeNeedsPermission( 'admin/blogs*', 'manage_blogs', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/comments*', 'manage_comments', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/users*', 'manage_users', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/roles*', 'manage_roles', Redirect::to('/admin') );

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
	if (Session::getToken() !== Input::get('csrf_token') &&  Session::getToken() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
