<?php
namespace App\Traits;

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

    /**
     * Paginate Array
     *
     * @param array $array
     * @param int $page
     * @param int $show_per_page
     *
     * @return array
    */
    function paganation($display_array, $page , $show_per_page = 10) {

        $page           = intval($page < 1 ? 1 : $page);

        // start position in the $display_array
        $show_per_page  = intval($show_per_page) ?? 1;

        $start          = ($page - 1) * ($show_per_page);

        $offset         = $show_per_page;

        $outArray       = array_slice($display_array, $start, $offset);

        return $outArray;
    }

}
