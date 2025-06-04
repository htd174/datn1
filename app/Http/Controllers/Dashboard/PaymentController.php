<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Model\RoomBooking;
use App\Model\EventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Session;

class PaymentController extends DashboardController
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function processRoomPayment($booking_id)
    {
        $booking = RoomBooking::findOrFail($booking_id);
        
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Unauthorized access');
        }

        if ($booking->payment) {
            return redirect()->back()->withErrors('Payment already processed');
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($booking->room_cost * 100), // Convert to cents, ép kiểu int
                'currency' => 'usd',
                'metadata' => [
                    'booking_id' => $booking->id,
                    'booking_type' => 'room'
                ]
            ]);

            return view('dashboard.payment.process', [
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $booking->room_cost,
                'booking' => $booking,
                'type' => 'room',
                'debugClientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Payment processing failed: ' . $e->getMessage());
        }
    }

    public function processEventPayment($booking_id)
    {
        $booking = EventBooking::findOrFail($booking_id);
        
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Unauthorized access');
        }

        if ($booking->payment) {
            return redirect()->back()->withErrors('Payment already processed');
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($booking->total_cost * 100), // Convert to cents, ép kiểu int
                'currency' => 'usd',
                'metadata' => [
                    'booking_id' => $booking->id,
                    'booking_type' => 'event'
                ]
            ]);

            return view('dashboard.payment.process', [
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $booking->total_cost,
                'booking' => $booking,
                'type' => 'event',
                'debugClientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Payment processing failed: ' . $e->getMessage());
        }
    }

    public function confirmPayment(Request $request)
    {
        $paymentIntentId = $request->input('payment_intent');
        $bookingType = $request->input('booking_type');
        $bookingId = $request->input('booking_id');

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                if ($bookingType === 'room') {
                    $booking = RoomBooking::findOrFail($bookingId);
                    $amount = $booking->room_cost;
                } else {
                    $booking = EventBooking::findOrFail($bookingId);
                    $amount = $booking->total_cost;
                }

                $booking->payment = true;
                $booking->save();

                return view('dashboard.payment.process', [
                    'clientSecret' => null,
                    'amount' => $amount,
                    'booking' => $booking,
                    'type' => $bookingType,
                    'debugClientSecret' => null,
                    'flash_title' => 'Success',
                    'flash_message' => 'Payment processed successfully!'
                ]);
            }

            return view('dashboard.payment.process', [
                'clientSecret' => null,
                'amount' => 0,
                'booking' => null,
                'type' => $bookingType,
                'debugClientSecret' => null,
                'flash_title' => 'Error',
                'flash_message' => 'Payment not completed.'
            ]);
        } catch (\Exception $e) {
            return view('dashboard.payment.process', [
                'clientSecret' => null,
                'amount' => 0,
                'booking' => null,
                'type' => $bookingType,
                'debugClientSecret' => null,
                'flash_title' => 'Error',
                'flash_message' => 'Payment confirmation failed: ' . $e->getMessage()
            ]);
        }
    }
} 