<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        return HotelResource::collection(Hotel::query()->paginate($request->per_page??15));
    }

    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }
    public function store(HotelRequest $request)
    {
        $this->authorize('hotel-manage');

        $hotel = Hotel::query()->create($request->validated());
        return response()->json([
            'message' => 'Hotel Created'
        ],201);
    }
    public function update(HotelRequest $request, Hotel $hotel)
    {
        $this->authorize('hotel-manage');

        $hotel->update($request->validated());
        return response()->json([
            'message' => 'Hotel Updated'
        ]);
    }

    public function destroy(Hotel $hotel)
    {
        $this->authorize('hotel-manage');

        $hotel->delete();
        return response()->json([
            'message' => 'Hotel Deleted'
        ],203);
    }

}
