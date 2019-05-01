<?php
/**
 * Guess my number, POST version.
 */

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
//require __DIR__ . "/src/Guess.php";


//INCOMMING
//$tries = $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;
//$number = $_POST["number"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
//$res = $_POST["res"] ?? null;




if (empty($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
    $_SESSION["game"]->random();
}
$game = $_SESSION["game"];
$number = $game->getNumber();
$tries = $game->tries();
if ($tries === 0) {
    $_SESSION = array();
    session_destroy();
    header("Refresh:0");
    return $this->res = "GAME OVER";
}
if ($doGuess) {
    $tries -= 1;
    $res = $game->makeGuess((int)$guess);
    if ($res === "CORRECT") {
        $_SESSION = array();
        session_destroy();
        header("Refresh:0");
    }
} elseif ($doCheat) {
    $number = $game->getNumber();
} elseif ($doInit) {
    $_SESSION = array();
    session_destroy();
    header("Refresh:0");
}


//$game = new Guess();
//$game->random();
//var_dump($game);
//$res = $game->makeGuess((int)$guess);
//var_dump($res);
//$number = $game->getNumber();
//$tries = $game->tries();
//var_dump($tries);


//Render page to HTML
require __DIR__ . "/view/guess_my_number.php";
