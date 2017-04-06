<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Support\Facades\Config

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
        /*
        $response = $next($request);
        $statusCode = $response->getStatusCode(); 
        $text = $response->body;
        $codeMessage = Response::$statusTexts[$statusCode]; 
        return Response::json(array('code' => '$statusCode', 'message' => '$codeMessage', 'body' => '$text'));
        */

        $response = $next($request);
        $statusCode = $response->getStatusCode();

        $body = [
            "code" =>$statusCode,
            "message" => Response::$statusTexts[$statusCode],
            "body" => $response->body
        ];

        $JsonOptions = 0;
        if(Config::get('app.debug', false))
            $JsonOptions = JSON_NUMERIC_CHECK | JSON_BIGINT_AS_STRING | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

        return response()->json($body, $statusCode, [], $JsonOptions);

    }
}
