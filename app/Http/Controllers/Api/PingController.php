<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class PingController extends Controller
{
    public function index()
    {
        echo 'Hey';
        return response()->json([
            'status' => 'ok',
            'timestamp' => Carbon::now(),
            'host' => request()->ip(),
        ]);
    }
}
