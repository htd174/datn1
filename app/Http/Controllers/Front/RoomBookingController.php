<?php

namespace App\Http\Controllers\Front;

use App\Algo\Booking;
use App\Model\RoomBooking;
use App\Model\RoomType;
use App\Rules\RoomAvailableRule;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\RoomBooked;


class RoomBookingController extends FrontController
{
    public function book(Request $request, $room_type_id)
    {
        if (!Auth::check()) {
            return Redirect::to("/login");
        }

        $rules = [
            'number_of_adult' => 'required|numeric|min:1',
            'number_of_child' => 'required|numeric|min:0',
            'arrival_date' => 'required|date|date_format:Y/m/d|after_or_equal:today',
            'departure_date' => 'required|date|date_format:Y/m/d|after_or_equal:'.$request->input('arrival_date'),
        ];

        $room_type = RoomType::findOrFail($room_type_id);
        $new_arrival_date = $request->input('arrival_date');
        $new_departure_date = $request->input('departure_date');
        
        // Check room availability first
        $booking = new Booking($room_type, $new_arrival_date, $new_departure_date);
        $available_room_id = $booking->available_room_number();
        
        if (!$available_room_id) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['booking_validation' => 'No rooms available for the selected dates.']);
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        try {
            $room_booking = new RoomBooking();
            $user = Auth::user();

            $startTime = Carbon::parse($new_arrival_date);
            $finishTime = Carbon::parse($new_departure_date);
            $no_of_days = $finishTime->diffInDays($startTime) ?: 1;
            
            $room_booking->arrival_date = $new_arrival_date;
            $room_booking->departure_date = $new_departure_date;
            $room_booking->room_cost = $no_of_days * $room_type->finalPrice;
            $room_booking->user_id = $user->id;
            $room_booking->room_id = $available_room_id;
            $room_booking->status = 'pending';
            $room_booking->save();

            $this->send_email($user->email);

            Session::flash('flash_title', "Success");
            Session::flash('flash_message', "Room has been booked successfully.");
            return redirect('/dashboard/room/booking');
            
        } catch (\Exception $e) {
            \Log::error('Room booking failed: ' . $e->getMessage());
            Session::flash('flash_title', "Error");
            Session::flash('flash_message', "Failed to book room. Please try again.");
            return redirect()->back()->withInput($request->all());
        }
    }

    private function send_email($email){
        if(empty($email)){
            $email = Auth::user()->email;
        }
        //Mail::to($email)->send(new RoomBooked());
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/avatars'), $avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }
        return back()->with('success', 'Avatar updated successfully!');
    }
}
