<?php




 $company = Company::where('name', '=', 'Компас')->take(1);
 
 var_dump($company);

?>