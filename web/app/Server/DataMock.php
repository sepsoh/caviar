<?php

namespace App\Server;

use function Symfony\Component\Translation\t;

class DataMock
{


    public function getStatus(){
        return [
            'result'=>true,
            'cpuUsage'=>40,
            'memoryUsage'=>77.5

        ];
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
    public function marketIndexThisDay(){
        return [[
            '2023-02-19T01:30:00.000Z',
            '2023-02-19T02:30:00.000Z',
            '2023-02-19T03:30:00.000Z',
            '2023-02-19T04:30:00.000Z',
            '2023-02-19T05:30:00.000Z',
            '2023-02-19T06:30:00.000Z',
            '2023-02-19T07:30:00.000Z',
            '2023-02-19T08:30:00.000Z',
            '2023-02-19T09:30:00.000Z',
            '2023-02-19T10:30:00.000Z'
        ],[10,18,15,19,30,44,60,88,55,60]

        ];
    }
    public function marketIndexThisMonth(){
        return [[
            '2023-02-19T01:30:00.000Z',
            '2023-02-19T02:30:00.000Z',
            '2023-02-19T03:30:00.000Z',
            '2023-02-19T04:30:00.000Z',
            '2023-02-19T05:30:00.000Z',
            '2023-02-19T06:30:00.000Z',
            '2023-02-19T07:30:00.000Z',
            '2023-02-19T08:30:00.000Z',
            '2023-02-19T09:30:00.000Z',
            '2023-02-19T10:30:00.000Z'
        ],[10,18,15,19,30,44,60,88,55,60]

        ];
    }
    public function marketIndexThisYear(){
        return [[
            '2023-02-19T01:30:00.000Z',
            '2023-02-19T02:30:00.000Z',
            '2023-02-19T03:30:00.000Z',
            '2023-02-19T04:30:00.000Z',
            '2023-02-19T05:30:00.000Z',
            '2023-02-19T06:30:00.000Z',
            '2023-02-19T07:30:00.000Z',
            '2023-02-19T08:30:00.000Z',
            '2023-02-19T09:30:00.000Z',
            '2023-02-19T10:30:00.000Z'
        ],[10,18,15,19,30,44,60,88,55,60]

        ];
    }


}
