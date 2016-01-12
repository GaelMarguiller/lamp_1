<?php
session_start();
if(!isset($_SESSION["choice"])) {
    $_SESSION["choice"] = rand(0, 100);
    $_SESSION['coup'] = 0;
}

$response = null;
if(!isset($_POST['guess']) || empty($_POST['guess'])) {
    $response = "Pas de nombre";
}
else{
    $guess = $_POST['guess'];
    if($guess > $_SESSION["choice"])
    {
        $response = "C'est moins";
        $_SESSION['coup']++;
    }
    elseif($guess < $_SESSION["choice"])
    {
        $response = "C'est plus";
        $_SESSION['coup']++;
    }else
    {
        $response = "C'est gagné<br>".$_SESSION['coup'].'<br>';
        if(!isset($_SESSION['score'])||($_SESSION['coup'] < $_SESSION['score']))
        {
            $_SESSION['score'] = $_SESSION['coup'];
        }
        unset($_SESSION['choice']);
        unset($_SESSION['coup']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Des papiers dans un bol</title>
</head>
<body>
<?php
echo $response.'<br>';
if(!isset($_SESSION['score']))
{
    echo $_SESSION['score'];
}
?>
<form method="POST" action="index.php">
    <input type="text" name="guess">
    <input type="submit">
</body>
</html>