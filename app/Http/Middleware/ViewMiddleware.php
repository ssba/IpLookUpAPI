<?php
namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Support\Facades\Config;

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

        $_body = $response->original;
        if(!is_null($response->exception)){
            if(!empty($response->exception->validator))
                $_body = $response->exception->validator;
            else
                $_body = null;
        }

        $body = [
            "code" =>$statusCode,
            "message" => Response::$statusTexts[$statusCode],
            "body" => $_body
        ];

        
        if(Config::get('app.debug', false)){
            

            //return view("debug",["json"=>$body]);
            return response()->view("debug",["json"=>$body]);
        }
        else{
            return response()->json($body, $statusCode);
        }

       


    }
}

