<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
 use App\Exceptions\Handler;
  use Validator; use GeoIP;

   class IpController extends Controller { 
   	public function Check(Request $request){ 
   		$validator = Validator::make($request->all(),[ 
   			'ip'=>'required|ip'  
   			]); 

   		if($validator->fails()){ 
   			throw new \Symfony\Component\HttpKernel\Exception\BadRequestExeption(); 
   		} 

   		$location = GeoIP::getLocation($request->ip); 

   		return $location; 
   	} 
   }