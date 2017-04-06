<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
 use App\Exceptions\Handler;
  use Validator; use GeoIP;

   class IpController extends Controller { 
   	public function Check(Request $request){ 
   		$validator = Validator::make($request->all(),[ 
   			'ip'->'ip' 
   			]); 
   	
   		if($validator->fails()){ 
   			throw new \Symfony\Component\HttpKernel\Exception\BadRequestExeption(); 
   		} 

   		$ip = $request->ip; 
   		$location = GeoIP::getLocation("$ip"); 

   		return $location; 
   	} 
   }