<?php

namespace App\Server;

use Illuminate\Support\Facades\Http;
use function Symfony\Component\Translation\t;

class Connector
{
    private  $address ;


    public function __construct()
    {
        $this->address = env('SERVER_ADDRESS');

    }
    public function isConnected(): bool
    {
        try {
            $response = $this->exec('getStatus',[]);
            if($response->result)
                return true;
        }catch (\Exception $e){}

        return false;
    }

    public function exec(string $method,array $data) : object {
        $response = Http::post($this->address.'/api/'.$method, $data);
        return $response->object();
    }
}
