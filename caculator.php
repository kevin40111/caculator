<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="caculator_CSS.css" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>計算機</title>
<script>

    var formula="";
    var number_lock=false,dot_lock=true,operator_lock=true;
    function btn_click(value){
        if(value=="btnC"){
            number_lock=false;
            dot_lock=true;
            operator_lock=true;
            formula="";
        }
        else if(value=="." && !dot_lock){
            formula += value;
            dot_lock=true;
        }
        else if(value=="btnbak"){
            formula = formula.substring(0,formula.length-1);

        }
        else if((value=="+" || value=="-" || value=="*" || value=="/") && !operator_lock){
            formula += value;
            operator_lock=true;
            dot_lock=true;
        }

        else if(value>="0" && value<="9"){
            formula += value;
            dot_lock=false;
            operator_lock=false;
        }

        else if(value == "-"){
            formula += value;

        }

        else if(value=="result"){
            SendRequest();

        }

        document.getElementById("formula_display").value = formula;
    }

    function SendRequest() {
      var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            formula = document.getElementById("formula_display").value = xhttp.responseText;

            //formula = xhttp.responseText;
            //console.log(xhttp.responseText);
        }
      };
      xhttp.open("GET","caculator_CAC.php?formula="+encodeURIComponent(formula), true);
      xhttp.send();
}

</script>


</head>
<body>
    <div class= "ui-cotent">
        <div class = "input-area">
            <input id="formula_display" class = "textBox form-control"  value="" type = "textBox" readonly>
        </div>

        <div class = "function-area container">
            <span id="btnC" onclick = "btn_click(this.id)" class="number btn btn-default">ｃ</span>
            <span id="btnbak" onclick = "btn_click(this.id)" class="number btn btn-default">←</span>
        </div>

        <div class = "number-area container" >
            <?for($i=1;$i<=9;$i++){?>
                <span id=<?= "$i";?> onclick = "btn_click(this.id)" class="number btn btn-default"><?=$i;?></span>
            <?}?>
                <span id="0" onclick = "btn_click(this.id)" class="number btn btn-default">0</span>
                <span id="." onclick = "btn_click(this.id)" class="number btn btn-default">.</span>
        </div>

        <div class="operator-area container">
            <span id="+" onclick = "btn_click(this.id)" class="number btn btn-default">+</span>
            <span id="-" onclick = "btn_click(this.id)" class="number btn btn-default">-</span>
            <span id="*" onclick = "btn_click(this.id)" class="number btn btn-default">×</span>
            <span id="/" onclick = "btn_click(this.id)" class="number btn btn-default">÷</span>
            <span id="result" onclick = "btn_click(this.id)" class="number btn btn-default">=</span>
        </div>

        <div class="clearfix"></div>
    </div>
</body>
</html>
