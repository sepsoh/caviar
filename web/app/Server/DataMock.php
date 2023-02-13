<?php

namespace App\Server;

class DataMock
{


    public function getStatus(){
        return true;
    }
    public function raw_allStockInformation(){
        return [
            // list of 100 random stocks
            [
                'symbol'=>'ABC',
                'name'=>'AmerisourceBergen Corporation'
            ],
            [
                'symbol'=>'ABCB',
                'name'=>'Ameris Bancorp'
            ],
            [
                'symbol'=>'ABM',
                'name'=>'ABM Industries Incorporated'
            ],
            [
                'symbol'=>'KAL',
                'name'=>'Kalera Public Limited Company'
            ],
            [
                'symbol'=>'ML',
                'name'=>'MoneyLion Inc.'
            ],
            [
                'symbol'=>'MLAB',
                'name'=>'Mesa Laboratories, Inc.'
            ],
            [
                'symbol'=>'OMI',
                'name'=>'Owens & Minor, Inc.'
            ],
        ];
    }

}
