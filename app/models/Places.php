<?php

class Places extends Eloquent {

	protected $points = 0;
	protected $calcClass;

	public function setPoints($score) {
		$this->points = $score;
	}

	public function getPoints() {
		return $this->points;
	}

	public function setCalcClass($class) {
		$this->calcClass = $class;
	}

	public function getCalcClass() {
		return $this->calcClass;
	}
  
}