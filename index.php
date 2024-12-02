<!DOCTYPE html>
<html>
<head>
	<title>
        Project Demo: Calculator App
    </title>
    <meta charset="utf-8">
    <link href= "css/style.css" rel="stylesheet" />
</head>
<body>
    <?php require_once "./calc/controller.php";?>

    <form method="post" >
        <table>
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
                <td>
                    <select name="op">
                        <option value="+">Add</option>
                        <option value="-">Subtract</option>
                        <option value="*">Multiply</option>
                        <option value="/">Divide</option>
                    </select>
                </td>
            </tr>
    
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Calculate Result"></td>
            </tr>
        </table>
    </form>
</body>
</html>
