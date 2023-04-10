<?php

namespace App\Http\Controllers\api\v1\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Http\Resources\HotelSearchResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelSearchController extends Controller
{
    public function index(Request $request){
        $hotels = Hotel::query()->with('city',
                                    'apartments.apartment_type',
                                            'apartments.rooms.room_type',
                                            'apartments.rooms.beds.bed_type')
            ->when($request->city_id, function($query) use ($request) {
                $query->where('city_id', $request->city_id);
            })
            ->when($request->country_id, function($query) use ($request) {
                $query->whereHas('city', fn($q) => $q->where('country_id', '=', $request->country_id));
            })
            ->when($request->adults && $request->children, function($query) use ($request) {
                $query->withWhereHas('apartments', function($query) use ($request) {
                    $query->where('capacity_adults', '>=', $request->adults)
                        ->where('capacity_children', '>=', $request->children)
                        ->orderBy('capacity_adults')
                        ->orderBy('capacity_children')
                        ->take(1);
                }); 
            })
            ->paginate($request->per_page??15);
        return HotelSearchResource::collection($hotels);
    }
}
