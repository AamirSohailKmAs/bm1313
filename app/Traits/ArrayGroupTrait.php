<?php

namespace App\Traits;

trait ArrayGroupTrait
{

  /**
   * @param Illuminate\Database\Eloquent\Collection $collection
   * @param string $groupBy
   * 
   * @return lluminate\Database\Eloquent\Collection
   */
  public function groupArray($collection, string $groupBy)
  {
    $temp = array();
    foreach ($collection as $key => $value) {
      $groupValue = $value->$groupBy;
      $data = $collection[$key];
      $temp[$groupValue][] = $data;
    }
    return $temp;
  }
}
