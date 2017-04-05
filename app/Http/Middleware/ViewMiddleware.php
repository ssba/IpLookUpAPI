<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response; 

class ViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $statusCode = $response->getStatusCode(); 
        $text = $response->body;
        $codeMessage = Response::$statusTexts[$statusCode]; 
        return Response::json(array('code' => '$statusCode', 'message' => '$codeMessage', 'body' => '$text'));

    }
}
