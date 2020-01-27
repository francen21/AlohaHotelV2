<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\ReservationsData;
use Carbon\Carbon;
class hasreservation implements Rule
{
    public $checkout = "";
    public $roomnumber = "";
    public $req = "";
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($checkout,$roomnumber)
    {
        $this->checkout = $checkout;
        $this->roomnumber = $roomnumber;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $check = ReservationsData::where('room_number', '=', $this->roomnumber)->whereBetween('check_in' , [$value, $this->checkout])->whereBetween('check_out' , [$value, $this->checkout])->count();
        if($check){
            $this->req = $check;
            return false;
        }
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Someone is already reserved on that date.'.$this->req;
    }
}
