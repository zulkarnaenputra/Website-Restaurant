<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\TravelPackage;
use App\Http\Requests\Admin\ReservationDetailRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RCheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = ReservationDetail::all();

        return view('pages.rcheckout',[
            'item' => $item
        ]);
    }

    public function create()
    {
        return view('pages.rcheckout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationDetailRequest $request, $id)
    {
        $item = ReservationDetail::with(['reservation', 'travel_package', 'user']);

        $data = $request->all();
        $this->validate($request, [
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i|after:time_start',
        ]);

        ReservationDetail::create($data); 
        return view('pages.rcheckout',[
        ]);
    }

    public function success(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->reservation_status = 'PENDING';

        $reservation->save();

        return view('pages.success');
    }

}
