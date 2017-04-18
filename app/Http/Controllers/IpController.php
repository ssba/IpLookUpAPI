<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\Handler;
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

        return $location;
    }
}