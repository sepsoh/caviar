<?php

namespace App\Server;

use Illuminate\Support\Facades\Http;
use function Symfony\Component\Translation\t;


class Connector
{

    public static function exec(string $method,array $data) : object {

        $response = Http::post( env('SERVER_ADDRESS').'/api/'.$method, $data);

        return $response->object();
    }

    public static function isConnected(): bool
    {
        try {
            $response = self::exec('getStatus',[]);
            if($response->result)
                return true;
        }catch (\Exception $e){}

        return false;
    }
}
