<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Validator;

use function GuzzleHttp\Promise\all;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $subscriber = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers',
        ]);

        if ($subscriber->passes()) {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
            return response()->json(['success' => 'Thanks for subscribing!']);
        }
        return response()->json(['error' => $subscriber->errors()->all()]);
    }
}