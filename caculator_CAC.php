<?
	$formula = $_GET["formula"];
	
	compute($formula);
	function compute($formula){
		$f_operator = array();
		$f_data = array();
		
		$index = 0;
		$number="";

		for($j=0;$j<strlen($formula);$j++){	
			/*將運算字串分割*/		
			if($formula[$j] == "+" || $formula[$j] == "-" || $formula[$j] == "*" || $formula[$j] == "/"){				
				$index = $j;					
				array_push($f_operator,$formula[$j]);
				array_push($f_data,$number);
				$number="";
			}else{
				$number.=$formula[$j];
			}
		}array_push($f_data,$number);
			print_r($f_data);

			$index=0;
			while($index<count($f_operator){
				/*將字串分別計算(乘除)*/
				if($f_operator[$index]=="*" || $f_operator[$index]=="/"){
					$result = cacul($f_operator[$index],$f_data[$index],$f_data[$index+1]);
					$f_data[$index] = $result;
					
					$index++;
				}
			}		
				
			$index=0;
			while($index<count($f_operator){
				/*將字串分別計算(加減)*/
				if($f_operator[$index]=="+" || $f_operator[$index]=="-"){
				
				
				}
			}

	}

	function cacul($oper,$valueA,$valueB){
		$result;
		switch($oper){
			case "+":
				$result = $valueA + $valueB; 
			break;
			case "-":
				$result = $valueA - $valueB;
			break;
			case "*":
				$result = $valueA * $valueB;
			break;	
			case "/":
				$result = $valueA / $valueB;
			break;
			default:

			break;
		}
		return $result;
	}

?>