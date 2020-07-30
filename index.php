<?php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="bg-info">

<div class="container text-center">

<div class="title mt-5">
    <h1>blackjack</h1>
</div>
<form action="index.php" method="POST" class="mt-5">
    <input type="submit" class="btn btn-danger text-center" value="hit" name="hit">
    <input type="submit" class="btn btn-danger text-center" value="stand" name="stand">
    <input type="submit" class="btn btn-danger text-center" value="surrender" name="surrender">
</form>

<?php

session_start();

if (!isset($_SESSION['test']))
{
    $_SESSION['test'] = new Blackjack();
}

if (isset($_POST['hit']))
{
    $_SESSION['test']->getPlayer()->Hit();
    if($_SESSION['test']->getPlayer()->getScore() <= Player::MAXPOINTS && $_SESSION['test']->getPlayer()->getScore() > $_SESSION['test']->getDealer()->getScore()){
        echo '<h4>you won</h4>';
        session_destroy();
    }elseif ($_SESSION['test']->getPlayer()->getScore() > Player::MAXPOINTS || $_SESSION['test']->getPlayer()->getScore() <= $_SESSION['test']->getDealer()->getScore()){
        echo '<h4>you lose</h4>';
        session_destroy();
    };
}

if (isset($_SESSION['surrender']))
{
    $_SESSION['test']->getPlayer()->surrender();
    echo '<h4>you lose</h4>';
    session_destroy();
}

if (isset($_POST['stand']))
{
    $_SESSION['test']->getDealer()->Hit();
    if($_SESSION['test']->getDealer()->getScore() >= $_SESSION['test']->getPlayer()->getScore() && $_SESSION['test']->getDealer()->getScore() <= player::MAXPOINTS){
        echo '<h4>dealer wins</h4>';
        session_destroy();
    }elseif ($_SESSION['test']->getDealer()->getScore() > Player::MAXPOINTS || $_SESSION['test']->getDealer()->getScore() < $_SESSION['test']->getPlayer()->getScore()){
        echo '<h4>dealer loses</h4>';
        session_destroy();
    };
}


$_SESSION['test']->display();

?>
</div>
</body>
</html>
<?php
/*$deck = new Deck();
$deck->shuffle();
foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}

$_SESSION['test'] = new Blackjack();
echo $_SESSION['test']->getPlayer();
echo $_SESSION['test']->getDealer();
*/
    ?>
