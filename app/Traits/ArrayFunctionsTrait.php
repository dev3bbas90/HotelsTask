<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait ArrayFunctionsTrait
{
    /**
     * Sort Array
     *
     * @param array $array
     * @param string $sortKey
     * @param string $sortType
     *
     * @return array
    */
    function sort(array $array , $sortKey , $sortType = 'ASC') : array {
        if(!$sortKey){ return $array;}

        usort($array, function ($a, $b) use($sortType , $sortKey) {
            $first_compared_item  = $sortType == 'DESC' ? $b : $a;
            $second_compared_item = $sortType == 'DESC' ? $a : $b;
            if($sortKey == 'price'){
                return $first_compared_item[$sortKey] > $second_compared_item[$sortKey] ;
            }else{
                return strcmp($first_compared_item[$sortKey], $second_compared_item[$sortKey]) ;
            }
        });
        return $array;
    }

}
