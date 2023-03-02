<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\Callback as Callback;
use Illuminate\Support\Facades\Auth;

class CallbackController extends Controller
{
   

    public function submit(Request $request)
    {
        // Валидация данных
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
    
    $callback = new Callback();
    $callback->theme = $request->subject;
    $callback->message = $request->message;
    $callback->user_id = $request->user_id;

    //Переименуем файл
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        // загрузим в папку
        $file->move(public_path('uploads'), $fileName);
        //ыернем новое название что бы закинуть в БД
        $callback->file = $fileName;
    }

    // сохраняем массив
    $callback->save();

        return back()->withErrors(['subject' =>'Ваша заявка отправлена']);
    }
}