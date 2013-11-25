<?php

class Products extends Eloquent {

protected $reportArr = array();

 public function category()
 {
 return $this->belongsTo('Category');
 }

public function setReportArr($arr) {
	$this->reportArr = $arr;
}

public function getReportArr() {
	return $this->reportArr;
}



}