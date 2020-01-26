<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ReservationsData;
class CountTodaysGuest extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return ['todayRes' => ReservationsData::where('check_in', '<=', new Carbon())->where('check_out', '>=', new Carbon())->count()];
    }
}
