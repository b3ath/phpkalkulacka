<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulačka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
 
        form {
            width: 300px;
            margin: 0 auto;
        }
 
        label {
            display: block;
            margin-bottom: 8px;
        }
 
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
 
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
 
        input[type="submit"]:hover {
            background-color: #45a049;
        }
 
        p {
            color: #333;
            text-align: center;
        }
 
        .error {
            color: red;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 >Kalkulačka</h1>
    <form method="post">
        <label for="num1">První číslo:</label>
        <input type="text" name="num1" id="num1" required value="<?php echo isset($num1) ? $num1 : ''; ?>"><br><br>
 
        <label for="operation">Operace:</label>
        <select name="operation" id="operation">
            <option value="add">Sčítání</option>
            <option value="subtract">Odčítání</option>
            <option value="multiply">Násobení</option>
            <option value="divide">Dělení</option>
        </select><br><br>
 
        <label for="num2">Druhé číslo:</label>
        <input type="text" name="num2" id="num2" required value="<?php echo isset($num2) ? $num2 : ''; ?>"><br><br>
 
        <input type="submit" value="Spočítat">
    </form>
 
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = isset($_POST["num1"]) ? filter_var($_POST["num1"], FILTER_SANITIZE_NUMBER_FLOAT) : null;
        $num2 = isset($_POST["num2"]) ? filter_var($_POST["num2"], FILTER_SANITIZE_NUMBER_FLOAT) : null;
        $operation = $_POST["operation"];
 
        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "<p class='error'>Dělení nulou není povoleno.</p>";
                }
                break;
            default:
                echo "<p class='error'>Neplatná operace.</p>";
                break;
        }
 
        if (isset($result)) {
            echo "<p>Výsledek operace: " . htmlspecialchars($result) . "</p>";
        }
    }
    ?>
</body>
</html>