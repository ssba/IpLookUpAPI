<?php

namespace App\Http\Controllers;

use DNSBLLookUp;
use Illuminate\Http\Request;
use App\Helper\DNSBLLookUpFacade;
use Illuminate\Support\Facades\Validator;
use GeoIP;
use Illuminate\Validation\ValidationException;


class IpController extends Controller
{
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip' => 'required|ip'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->all());
        }


        $location = GeoIP::getLocation($request->ip);
        $result = (string) DNSBLLookUpFacade::Check($location);

        return response()->json([
            "result" => DNSBLLookUpFacade::Check($location),
            "location" => $location->toArray()
        ]);
    }
}