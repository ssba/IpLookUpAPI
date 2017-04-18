<?php

namespace App\Http\Controllers;

use DNSBLLookUp;
use Illuminate\Http\Request;
use App\Helper\DNSBLLookUpFacade;
use Illuminate\Support\Facades\Validator;
use Torann\GeoIP\GeoIP;
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

        return DNSBLLookUpFacade::Check($location);
    }
}