<?php

namespace Witty\LaravelTableView\Middleware;

class LookInStorage
{
	/**
     * @param \Illuminate\Http\Request $request
     * @param mixed $storedSearchQuery
     * @param mixed $storedPageNumber
     * @return array
     */
    public static function forRedirectParameters($request, $storedSearchQuery, $storedPageNumber)
    {
		$redirectParameters = $request->all();

		if ( $storedSearchQuery ) 
		{
			$redirectParameters['q'] = $storedSearchQuery;
		}

		if ( $storedPageNumber ) 
		{
			$redirectParameters['page'] = $storedPageNumber;
		}

		return $redirectParameters;
    }

	/**
     * @param \Illuminate\Http\Request $request
     * @param string $currentRouteName
     * @return mixed
     */
    public static function forSearch($request, $currentRouteName)
    {
    	if ( ! $request->has('q') 
    		&& $request->input('q') !== '' 
    		&& $request->cookie($currentRouteName . '_searchQuery') )
		{
			return $request->cookie($currentRouteName . '_searchQuery');
		}

		return false;
    }

	/**
     * @param \Illuminate\Http\Request $request
     * @param string $currentRouteName
     * @return mixed
     */
    public static function forPage($request, $currentRouteName)
    {
		if ( ! $request->has('page') 
			&& $request->input('page') !== '0' 
			&& $request->cookie($currentRouteName . '_currentPage') )
		{
			return $request->cookie($currentRouteName . '_currentPage');
		}

		return false;
    }
}
