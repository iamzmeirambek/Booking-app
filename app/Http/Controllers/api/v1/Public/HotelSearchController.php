<?php

namespace App\Http\Controllers\api\v1\Public;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelSearchController extends Controller
{
    public function __invoke(Request $request){
        return Hotel::query()->with('city')->get();
    }
}
