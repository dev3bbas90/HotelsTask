<?php

namespace App\Http\Controllers;

use App\Http\Services\HotelsService;
use App\Traits\ArrayFunctionsTrait;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    use ArrayFunctionsTrait;
    protected $HotelsService;
    public function __construct(HotelsService $HotelsService )
    {
        $this->HotelsService = $HotelsService;
    }

    /**
     * List the Hotels data
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
    */
    function index(Request $request) {
        $sortQuery        = $request->sort;
        $sortTypeQuery    = $request->sortType;

        // fetch hotels Data
        $hotelsJsonResponse      = $this->HotelsService->testHotels();
        // $hotelsJsonResponse     = $this->HotelsService->fetchData();

        if($hotelsJsonResponse['status'] != 'success'){
            return $hotelsJsonResponse['message'];
        }
        $response_data          = @$hotelsJsonResponse['data'] ?? [];
        // hotels
        $hotels_data            = @$response_data['hotels'] ?? [];
        // Sort Hotels Array According given attributes
        $hotels_data_sorted     = $this->sort($hotels_data , $sortQuery , $sortTypeQuery);

        // Filter Sorted Hotes data According given parameters
        $filteredData = $this->HotelsService->filterArray($hotels_data_sorted , $request);

        $hotels = $this->paganation($filteredData , $request->page ?? 1 ,$request->limit ?? 10);
        // Return View with Hotels Data
        return view('hotels.index' , compact('hotels'));
    }

}
