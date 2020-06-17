<?php


namespace App\Helpers;


use App\Callback;

class CallbackFactory
{
    public function createCallback($data)
    {
        $fileName = $data['phone'] . ".txt";
        $callbackFile = fopen($fileName, "w");
        $txt = $data['name'] . "\n";
        fwrite($callbackFile, $txt);
        $txt = $data['phone'] . "\n";
        fwrite($callbackFile, $txt);
        $txt = $data['message'] . "\n";
        fwrite($callbackFile, $txt);
        fclose($callbackFile);

        $data['file'] = $fileName;

        return Callback::create($data);
    }
}
