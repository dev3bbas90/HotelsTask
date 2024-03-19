<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HotelsService
{
    /**
     * Fetch the Hotels data
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function fetchData(): array
    {
        // Make the request to the third-party API
        $response = Http::get('https://api.npoint.io/dd85ed11b9d8646c5709');

        // Check if request was successful
        if ($response->successful()) {
            // Parse JSON response
            $jsonData = $response->json();

            // Return filtered data as JSON response
            return [
                'status' => 'success' ,
                'data'   => $jsonData
            ];
        } else {
            // Handle unsuccessful response
            return [
                'status'  => 'error',
                'message' => 'Failed to fetch data from third-party API'
            ];
        }
    }

    public function testHotels()
    {
        $json = [
            "hotels" => [
                [
                    "city" => "dubai",
                    "name" => "Media One Hotel",
                    "price" => 102.2,
                    "availability" => [
                        [
                        "to" => "15-10-2023",
                        "from" => "10-10-2023"
                        ],
                        [
                        "to" => "15-11-2023",
                        "from" => "25-10-2023"
                        ],
                        [
                        "to" => "15-12-2023",
                        "from" => "10-12-2023"
                        ]
                    ]
                ],
                [
                    "city" => "cairo",
                    "name" => "Rotana Hotel",
                    "price" => 80.6,
                    "availability" => [
                        [
                        "to" => "12-10-2023",
                        "from" => "10-10-2023"
                        ],
                        [
                        "to" => "10-11-2023",
                        "from" => "25-10-2023"
                        ],
                        [
                        "to" => "18-12-2023",
                        "from" => "05-12-2023"
                        ]
                    ]
                ],
                [
                    "city" => "london",
                    "name" => "Le Meridien",
                    "price" => 89.6,
                    "availability" => [
                        [
                        "to" => "12-10-2023",
                        "from" => "01-10-2023"
                        ],
                        [
                        "to" => "10-11-2023",
                        "from" => "05-10-2023"
                        ],
                        [
                        "to" => "28-12-2023",
                        "from" => "05-12-2023"
                        ]
                    ]
                ],
                [
                    "city" => "paris",
                    "name" => "Golden Tulip",
                    "price" => 109.6,
                    "availability" => [
                        [
                        "to" => "17-10-2023",
                        "from" => "04-10-2023"
                        ],
                        [
                        "to" => "11-11-2023",
                        "from" => "16-10-2023"
                        ],
                        [
                        "to" => "09-12-2023",
                        "from" => "01-12-2023"
                        ]
                    ]
                ],
                [
                    "city" => "Vienna",
                    "name" => "Novotel Hotel",
                    "price" => 111,
                    "availability" => [
                        [
                        "to" => "28-10-2023",
                        "from" => "20-10-2023"
                        ],
                        [
                        "to" => "20-11-2023",
                        "from" => "04-11-2023"
                        ],
                        [
                        "to" => "24-12-2023",
                        "from" => "08-12-2023"
                        ]
                    ]
                ],
                [
                    "city" => "Manila",
                    "name" => "Concorde Hotel",
                    "price" => 79.4,
                    "availability" => [
                        [
                        "to" => "19-10-2023",
                        "from" => "10-10-2023"
                        ],
                        [
                        "to" => "22-11-2023",
                        "from" => "22-10-2023"
                        ],
                        [
                        "to" => "20-12-2023",
                        "from" => "03-12-2023"
                        ]
                    ]
                ]
            ]
        ];
        return [
            'status' => 'success' ,
            'data'   => $json
        ];
    }

     /**
     * Filter Array
     *
     * @param array $array
     * @param \Illuminate\Http\Request $request
     *
     * @return array
    */
    function filterArray(array $array , Request $request) : array
    {
        return array_filter(@$array, function ($item) use($request) {
            $nameQuery        = $request->name;
            $destinationQuery = $request->destination;
            $minPriceQuery    = $request->minPrice;
            $maxPriceQuery    = $request->maxPrice;
            $minDateQuery     = $request->minDate;
            $maxDateQuery     = $request->maxDate;
            $query            = $item;
            if($nameQuery){
                $query            = $query && stripos($item['name'], $nameQuery) !== false;
            }
            if($destinationQuery){
                $query            = $query && stripos($item['city'], $destinationQuery) !== false;
            }
            if($minPriceQuery){
                $query            = $query && $item['price'] >= $minPriceQuery;
            }
            if($maxPriceQuery){
                $query            = $query && $item['price'] <= $maxPriceQuery;
            }
            if($minDateQuery || $maxDateQuery){
                $availability = array_filter(@$item['availability'] , function ($slot) use($minDateQuery , $maxDateQuery) {
                    $slot_query     = $slot;
                    $slot_from_date = date_create($slot['from'])->format('Y-m-d');
                    $slot_to_date   = date_create($slot['to'])->format('Y-m-d');
                    $minDateQuery   = date_create($minDateQuery)->format('Y-m-d');
                    $maxDateQuery   = date_create($maxDateQuery)->format('Y-m-d');
                    if($minDateQuery){
                        $slot_query            = $slot_query && ($slot_from_date >= $minDateQuery);
                    }
                    if($maxDateQuery){
                        $slot_query            = $slot_query && ($slot_to_date <= $maxDateQuery);
                    }
                    return $slot_query;
                });
                $query            = $query && count(@$availability);
            }
            return $query;
        });
    }

}
