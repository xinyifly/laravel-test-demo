<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HttpbinController extends Controller
{
    function index() {
        $response = \Guzzle::get('https://httpbin.org/get');
        return json_decode($response->getBody(), true);
    }
}
