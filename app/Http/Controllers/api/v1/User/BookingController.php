<?php

namespace App\Http\Controllers\api\v1\User;

use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $this->authorize('bookings-manage');

        return response()->json(['success' => true]);

    }
}
