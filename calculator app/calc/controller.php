<?php require_once "./calculator.php";

$answer = "";

if(isset($_POST['submit']))
{ 
    $calculator = new calc\calculator;
    $sign = $_POST['op'];
    switch($sign) {
        case '+':
            $answer = $calculator->add($_POST['num1'],$_POST['num2']);
            break;
        case '-':
            $answer = $calculator->subtract($_POST['num1'],$_POST['num2']);
            break;
        case '*':
            $answer = $calculator->multiply($_POST['num1'],$_POST['num2']);
            break;
        case '/':
            $answer = $calculator->divide($_POST['num1'],$_POST['num2']);
            break;
        default:
            echo "Select an operator";
            break;
    }
    echo "<div class=\"answer\"> Result = {$_POST['num1']} {$_POST['op']} {$_POST['num2']} = {$answer} </div>";
}
else{
    echo "<div class=\"answer\"> Please enter the input values. </div>";
}