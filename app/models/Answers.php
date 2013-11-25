<?php

class Answers extends Eloquent {


	 public function place()
	 {
	 return $this->belongsTo('Places');
	 }

	 public function product()
	 {
	 return $this->belongsTo('Products');
	 }

	 public function form()
	 {
	 return $this->belongsTo('Forms');
	 }

	 public function category()
	 {
	 return $this->belongsTo('Category');
	 }

	 public function sss(){
	 	$this
	 		->select('*');
	 }
 
}