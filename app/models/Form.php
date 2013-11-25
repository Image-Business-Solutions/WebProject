<?php

class Forms extends Eloquent {

 protected $table = 'forms';
	
 public function company()
 {
 return $this->belongsTo('Company');
 }

}