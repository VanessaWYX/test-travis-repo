<?php 
$result = "";
class calculator
{
    var $num1;
    var $num2;

    function checkoperation($operator)
    {
        switch($operator)
        {
            case '+':
            return $this->num1 + $this->num2;
            break;

            case '-':
            return $this->num1 - $this->num2;
            break;

            case '*':
            return $this->num1 * $this->num2;
            break;

            case '/':
            return $this->num1 / $this->num2;
            break;

            default:
            return "Sorry No command found";
        }   
    }
    function getresult($num1, $num2, $c)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        return $this->checkoperation($c);
    }
}

$cal = new calculator();
if(isset($_POST['submit']))
{   
    $result = $cal->getresult($_POST['num1'],$_POST['num2'],$_POST['op']);
}
?>
<link href= "css/style.css" rel="stylesheet" />
<form method="post" >
<table align="center">
    <tr>
        <td>1st Number</td>
        <td><input type="number" name="num1"></td>
    </tr>

    <tr>
        <td>2nd Number</td>
        <td><input type="number" name="num2"></td>
    </tr>

    <tr>
        <td>Select Operator</td>
        <td><select name="op">
            <option value="+">Add</option>
            <option value="-">Subtract</option>
            <option value="*">Multiply</option>
            <option value="/">Divide</option>
        </select></td>
    </tr>

    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Calculate Result"></td>
    </tr>
    <tr>
        <td><strong>Result = <?php echo $result; ?><strong></td>
    </tr>
</table>
</form>