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
            "ip" => $location->ip,
            "iso_code" => $location->iso_code,
            "country" => $location->country,
            "city" => $location->city,
            "state" => $location->state,
            "state_name" => $location->state_name,
            "postal_code" => $location->postal_code,
            "lat" => $location->lat,
            "lon" => $location->lon,
            "timezone" => $location->timezone,
            "continent" => $location->continent,
            "currency" => $location->currency,
            "default" => $location->default,
            "cached" => $location->cached
        ]);
    }
}