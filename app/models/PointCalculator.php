<?php
class PointCalculator {


	public function kompasCalculation($place, $company, $date) {
		// echo $place->getCalcClass()->name;
		$companyId = $company->id;
		$forms = Forms::where('company_id', '=', $companyId)->get();
		
		$formIds = array();
		foreach ($forms as $form) {
			array_push($formIds, $form->id);
		}

		$answers = Answers::where('place_id', '=', $place->id)->whereIn('form_id', $formIds)->where(DB::raw('MONTH(date)'), '=', $date)->orderBy('date')->groupBy('form_id')->groupBy('question_id')->get();
		// $answers = Answers::where('place_id', '=', $place->id)->where(DB::raw('MONTH(date)'), '=', 3)->get();
		$points = 0;
		foreach ($answers as $key) {
			// echo 'ID: '.$key->id." qID: ".$key->question_id. " qAnswer: ".$key->answer;

			// echo 'ID: '.$key->id.' pID: '.$key->product_id.' date: '.$key->date.'</br>';
			// echo 'Question ID: ' .$key->question_id;
			if ($key->question_id == 4) {
							// echo 'xxxx: '.$key->answer;
				if($key->answer > 0) {
					// echo '>0';
					$points = $points + $key->product->points; 
				} else {
					$points = $points - 3;
				}
			} elseif ($key->question_id == 2) {
				if($key->answer == '-10%') {
					$points = $points - 10;
				} elseif ($key->answer == '-20%') {
					$points = $points - 25;
				} elseif ($key->answer == '-30%') {
					$points = $points - 50;
				} elseif ($key->answer == '10%') {
					$points = $points + 10;
				} elseif ($key->answer == '20%') {
					$points = $points + 25;
				} elseif ($key->answer == '30%') {
					$points = $points + 50;
				}
			} elseif ($key->question_id == 5) {
				if($key->answer) {
					$points = $points + 0;
				} 
			} elseif ($key->question_id == 6) {
				if($key->answer) {
					$points = $points + 25;
				} 
			} elseif ($key->question_id == 1) {
				if($key->category->name == 'Пастет') {
					if($place->getCalcClass()->name == 'A') {
						if($key->answer >= 22) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'B') {
						if($key->answer >= 17) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'B') {
						if($key->answer >= 8) {
							$points = $points + 10;
						}
					}
				} elseif($key->category->name == 'Месни') {
					if($place->getCalcClass()->name == 'A') {
						if($key->answer >= 11) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'B') {
						if($key->answer >= 6) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'C') {
						if($key->answer >= 5) {
							$points = $points + 10;
						}
					}
				} elseif($key->category->name == 'Рибни') {
					if($place->getCalcClass()->name == 'A') {
						if($key->answer >= 20) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'B') {
						if($key->answer >= 10) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'C') {
						if($key->answer >= 5) {
							$points = $points + 10;
						}
					}
				} elseif($key->category->name == 'Лютеница') {
					if($place->getCalcClass()->name == 'A') {
						if($key->answer >= 6) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'B') {
						if($key->answer >= 3) {
							$points = $points + 10;
						}
					} elseif($place->getCalcClass()->name == 'C') {
						if($key->answer >= 1) {
							$points = $points + 10;
						}
					}
				}
			}
			// echo "Points: " .$points;
			// echo "</br>";
		}
		$place->setPoints($points);
		// echo $place->getPoints();
		// $results = DB::table( $query->select(DB::raw('*'))->from('answers')->where('place_id', '=', $place->id)->where('form_id', '=', 36)->where('product_id', '=', 1))->get();

/*		$res = DB::table(function($query) {
							$query->select(DB::raw('*'))
	                      ->from('answers')
	                      ->whereRaw('place_id = 1');
						})->get();*/

		$res = DB::table('answers')->where('place_id', '=', $place->id );
		// $res = DB::table(DB::table('answers'))->select(DB::raw('new.*'))->get();
		return $res;
	}

	public function calculate($place, $company, $date) {
		if($company->name == 'Компас' ) {
			$this->kompasCalculation($place, $company, $date);
		}
	}



}