<?php

namespace Tests\Unit;

use App\Http\Services\HotelsService;
use App\Traits\ArrayFunctionsTrait;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ArrayFunctionsTest extends TestCase
{
    use ArrayFunctionsTrait;

    /**
     * Test Filter Array.
    */
    public function test_filter_array(): void
    {
        $request = new Request([
            'name' => 'Rotana',
            'minPrice' => 25,
        ]);
        $array = [
            [
                'name' => 'Rotana',
                'price' => 20,
            ],
            [
                'name' => 'Rotana 2',
                'price' => 30,
            ]
        ];

        $supposed_response = [
            '1' => [
                'name' => 'Rotana 2',
                'price' => 30,
            ]
        ];
        $HotelsService = new HotelsService();
        $filteredData = $HotelsService->filterArray($array , $request);
        $this->assertEquals($filteredData, $supposed_response);

        $this->assertCount(
            1,
            $filteredData, "Array doesn't Filtered"
        );
    }
}
