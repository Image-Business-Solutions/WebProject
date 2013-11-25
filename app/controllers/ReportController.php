<?php
class ReportController extends BaseController {

	public $layout = 'FullReport';

	public function showReport() {


			$date = $_GET['date'];
			$company = Company::find($_GET['company']);
			$calculator = new PointCalculator();
			$views = array();

			$pr = $company->categories;
			// foreach ($pr as $key) {
			// 	echo $key->name;
			// }
			$classifications = Classification::where('company_id' , '=', $company->id)->get();

			foreach ($classifications as $classification) {
				$view = View::make('ClassificationView')->with('name', $classification->name)->render();
				
				array_push($views, $view);
				
				$i=1;
				foreach ($classification->places as $place) {
					# code...
					$place->setCalcClass($classification);
					$calculator->calculate($place, $company, $date);
					$view = View::make('PlaceReportView')->with('place', $place)->render();
					array_push($views, $view);
				}


			}


			// $forms = Forms::where('company_id', '=', $company->id)->take(999)->get();

			return View::make('SimpleReport')->with(array('views' => $views, 'date' => $date));
	}

	public function showFullReport() {
		$date = $_GET['date'];
		$place = Places::find($_GET['place']);
		

		$company = Company::where('name', '=', 'Компас')->firstOrFail();

		$res = DB::table('places_classifications')
        ->join('places', 'places.id', '=', 'places_classifications.place_id' )
        ->join('classifications', 'places_classifications.classification_id', '=', 'classifications.id')->where('places.id' ,'=', $place->id)->where('classifications.company_id', '=', $company->id)
        ->select('classifications.*')->first();
        if($res == null) {
        	App::abort(401,'Този магазин няма класификация от фирмата Компас');
        } 
        // echo "Result: ".$res->name;

		$forms = Forms::where('company_id', '=', $company->id)->get();
		
		$formIds = array();
		foreach ($forms as $form) {
			array_push($formIds, $form->id);
		}

		$answers = Answers::where('place_id', '=', $place->id)->whereIn('form_id', $formIds)->where(DB::raw('MONTH(date)'), '=', $date)->orderBy('date')->groupBy('form_id')->groupBy('question_id')->get();

		$company = Company::where('name', '=', 'Компас')->firstOrFail();
		// $products = $company->products;
		$categories = $company->categories;
		$views = array();
		$infoArr = array();
		$categoryInfoArr = array();
		foreach ($categories as $key) {
			// echo "category: ".count($this->getAnswersForCategory($key,$answers));
			$categoryInfoArr = $this->buildCategoryInfoArr($key, $res->name, $this->getAnswersForCategory($key,$answers));
			$products = Products::where('category_id', '=', $key->id)->where('company_id', '=', $company->id)->get();
			
			foreach ($products as $product) {
				$arr = $this->getAnswersForProduct($product, $answers);
				$i = $product->id;
				// echo "productID: ".$i."</br>";

				$buffArr = $this->buildArr($arr);
				$infoArr[$i] = $buffArr;
		
				
				
			

			}
			
			// echo 'Count:'.count($arr);
			// $this->buildArr($arr);

			$view = View::make('home')->with(array('categoryInfoArr' => $categoryInfoArr, 'products' => $products, 'productsInfoArr' => $infoArr));
			array_push($views, $view);
		}
		// var_dump($infoArr);
		$this->layout->title = 'title';
	    $this->layout->content = $views;
	    $this->layout->place = $place;
	}

	public function getAnswersForProduct($product, $answers) {
		$answersArr = array();
		foreach ($answers as $key) {
			if($key->product_id == $product->id) {
				// echo $key->id.'</br>';
				array_push($answersArr, $key);
			}
		}

		return $answersArr;
	}

	public function getAnswersForCategory($category, $answers) {
		$answersArr = array();
		foreach ($answers as $key) {
			if($key->category_id == $category->id) {
				// echo $key->id.'</br>';
				array_push($answersArr, $key);
			}
		}

		return $answersArr;
	}

	public function buildArr($arr) {
		$buildedArr = array();
		foreach ($arr as $key) {
			if($key->question_id == 4) {
				// echo 'asnwersID'.$key->id;
				if($key->answer > 0) {
					$buildedArr['countPoints'] = $key->product->points;
					$buildedArr['missing'] = '';
					// echo "Pointssss: ".$buildedArr['countPoints'];
				} else {
					$buildedArr['countPoints'] = 0;
					$buildedArr['missing'] = -3;
					// echo "Pointssss: ".$buildedArr['missing'];
				}
			} else if($key->question_id == 7) {
				if($key->answer) {
					$buildedArr['missingPrice'] = -2;
				} else {
					$buildedArr['missingPrice'] = '';
				}
			} else if($key->question_id == 6) {
				if($key->answer) {
					$buildedArr['secondPoint'] = 25;
				} else {
					$buildedArr['secondPoint'] = '';
				}
			}
		}
		if(!array_key_exists("countPoints", $buildedArr)) {
			$buildedArr['countPoints'] = 0;
		}
		if(!array_key_exists("missing", $buildedArr)) {
			$buildedArr['missing'] = '';
		}		
		if(!array_key_exists("missingPrice", $buildedArr)) {
			$buildedArr['missingPrice'] = '';
		}
		if(!array_key_exists("secondPoint", $buildedArr)) {
			$buildedArr['secondPoint'] = '';
		}
		return $buildedArr;
	}

	public function buildCategoryInfoArr($category, $placeClass, $answersArr) {
		$buildedArr = array();
		$buildedArr['name'] = $category->name;
		if($category->name == "Пастет") {
			$buildedArr['A'] = 22;
			$buildedArr['B'] = 17;
			$buildedArr['C'] = 8;
		} else if($category->name == "Месни") {
			$buildedArr['A'] = 11;
			$buildedArr['B'] = 6;
			$buildedArr['C'] = 5;
		} else if($category->name == "Рибни") {
			$buildedArr['A'] = 20;
			$buildedArr['B'] = 10;
			$buildedArr['C'] = 5;
		}  else if($category->name == "Лютеница") {
			$buildedArr['A'] = 6;
			$buildedArr['B'] = 3;
			$buildedArr['C'] = 1;
		}

		foreach ($answersArr as $answer) {
			if($answer->question_id == 1) {
				if(array_key_exists($placeClass, $buildedArr)) {
					if($answer->answer > $buildedArr[$placeClass]) {
						$buildedArr['SKUpoints'] = 10;
					} else {
						$buildedArr['SKUpoints'] = 0;
					}

					$buildedArr['SKUcount'] = $answer->answer;

				}
			} elseif ($answer->question_id == 2) {
				if($answer->answer == '-10%') {
					$buildedArr['percentPoint'] = -10;
					$buildedArr['percents'] = $answer->answer;
				} elseif ($answer->answer == '-20%') {
					$buildedArr['percentPoint'] = -25;
					$buildedArr['percents'] = $answer->answer;
				} elseif ($answer->answer == '-30%') {
					$buildedArr['percentPoint'] = -50;
					$buildedArr['percents'] = $answer->answer;
				} elseif ($answer->answer == '10%') {
					$buildedArr['percentPoint'] = 10;
					$buildedArr['percents'] = $answer->answer;
				} elseif ($answer->answer == '20%') {
					$buildedArr['percentPoint'] = 25;
					$buildedArr['percents'] = $answer->answer;
				} elseif ($answer->answer == '30%') {
					$buildedArr['percentPoint'] = 50;
					$buildedArr['percents'] = $answer->answer;
				}
			}
		
		}

		if(!array_key_exists("SKUpoints", $buildedArr)) {
		$buildedArr['SKUpoints'] = '0';
		}
		if(!array_key_exists("SKUcount", $buildedArr)) {
		$buildedArr['SKUcount'] = '';
		}
		if(!array_key_exists("percentPoint", $buildedArr)) {
		$buildedArr['percentPoint'] = '0';
		}
		if(!array_key_exists("percents", $buildedArr)) {
		$buildedArr['percents'] = '?';
		}				
		return $buildedArr;
	}

}