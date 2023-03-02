<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\Callback as Callback;

class CallbackController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request data
    $request->validate([
        'user_id' => 'required',
        'subject' => 'required',
        'message' => 'required',
        'attachment' => 'required|file|max:3000000|mimes:jpeg,png,jpg,pdf,doc,docx'
    ]);
    $lastCallback = Callback::where('user_id', $request->user_id)
    ->orderBy('created_at', 'desc')
    ->first();
    if ($lastCallback && ($lastCallback->created_at->diffInSeconds(Carbon::now()) < 86400)) {
        return back()->withErrors([
            'subject' => 'Вы сегодня уже оставляли заявку. Ожидайте 24 часа.']);
        }
    // Store the data
    $callback = new Callback();
    $callback->theme = $request->subject;
    $callback->message = $request->message;
    $callback->user_id = $request->user_id;

    // Upload and rename file
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        // Move the file and rename it
        $file->move(public_path('uploads'), $fileName);
        // Set the file name
        $callback->file = $fileName;
    }

    // Save the data
    $callback->save();

        return back()->with('success', 'Your feedback has been submitted successfully!');
    }
}