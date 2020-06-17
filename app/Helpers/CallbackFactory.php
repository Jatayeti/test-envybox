<?php


namespace App\Helpers;


use App\Callback;

class CallbackFactory
{
    public function createCallback($data)
    {
        if (config('app.callback_store') == 'db') {
            return $this->storeOnDB($data);
        }

        if (config('app.callback_store') == 'file') {
            return $this->writeOnFile($data);
        }

        if (config('app.callback_store') == 'all') {
            $data['file'] = $this->writeOnFile($data);

            return $this->storeOnDB($data);
        }
    }

    public function storeOnDB($data)
    {
        return Callback::create($data);
    }

    public function writeOnFile($data)
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

        return $fileName;
    }
}
