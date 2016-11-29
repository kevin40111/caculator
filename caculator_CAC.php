<?
	include "sql_info.php";

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
		

	    
		//先乘除法
		//unset
		//array_value
		for($i=0;$i<sizeof($f_operator);$i++){
			if($f_operator[$i]=="*" || $f_operator[$i]=="/"){
				$f_data[$i] = cacul($f_operator[$i],$f_data[$i],$f_data[$i+1]);				
				unset($f_data[($i+1)]);
				unset($f_operator[$i]);
				$f_data = array_values($f_data);
				$f_operator = array_values($f_operator);	
				$i=-1;		
			}
		}

		//後加減法
		for($i=0;$i<sizeof($f_operator);$i++){
			if($f_operator[$i]=="+" || $f_operator[$i]=="-"){

				$f_data[$i] = cacul($f_operator[$i],$f_data[$i],$f_data[$i+1]);
				unset($f_data[($i+1)]);
				unset($f_operator[$i]);
				$f_data = array_values($f_data);
				$f_operator = array_values($f_operator);	
				$i=-1;		
			}


		}

		//print_r($f_data);
		//print_r($f_operator);
		
		$sql_base = new sqlinfo();
		
		
		$sql  = "INSERT INTO caculator (formula, result, write_date)" ;
		$sql .= "VALUES ('2+3+4', '9',".date("Y-m-d").")";
		$sql_base->sql_query($sql);
		
		echo $f_data[0];

	}

	
	function cacul($oper,$valueA,$valueB){
		$cac_result="";
		switch ($oper) {
			case '+':
				$cac_result = $valueA + $valueB;		
				break;
			case '-':
				$cac_result = $valueA - $valueB;
				break;
			case '*':
				$cac_result = $valueA * $valueB;
				break;
			case '/':
				$cac_result = $valueA / $valueB;
				break;
			default:
				echo "error";
				break;
		}

		return $cac_result;
	}

?>