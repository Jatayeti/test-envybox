<?php

namespace App\Http\Controllers;

use App\Callback;
use App\Helpers\CallbackFactory;
use Illuminate\Http\Request;

class CallbacksController extends Controller
{
    public function index(Request $request)
    {
        $callbacks = Callback::orderBy('created_at', 'desc')->get();

        return compact('callbacks');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'Введите ваше имя',
            'phone.required' => 'Введите ваше телефон',
            'message.required' => 'Введите ваше сообщение',
        ]);

        $callbackFactory = new CallbackFactory();

        $callback = $callbackFactory->createCallback($data);

        return compact('callback');
    }

    public function delete(Callback $callback) {
        unlink($callback->file);
        return $callback->delete();
    }
}
