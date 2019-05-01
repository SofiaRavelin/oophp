<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to START the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the gamestart.
    $_SESSION["game"] = new Sorv\Guess\Guess();
    $game = $_SESSION["game"];
    $game->random();
    $_SESSION["number"] = $game->getNumber();
    $_SESSION["tries"] = $game->tries();
    return $app->response->redirect("guess/play");
});


/**
 * Play the game.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the Game";

    //Get current settings from SESSION
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["doCheat"] = null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - Make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the Game";
    //INCOMMING
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // GET current settings
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;


    $game = new Sorv\Guess\Guess($number, $tries);

    if ($doGuess) {
        //$tries -= 1;
        $res = $game->makeGuess((int)$guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["guess"] = $guess;
        $_SESSION["res"] = $res;
    } elseif ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    } elseif ($doInit) {
        $_SESSION["game"] = new Sorv\Guess\Guess();
        $game = $_SESSION["game"];
        $game->random();
        $_SESSION["number"] = $game->getNumber();
        $_SESSION["tries"] = $game->tries();
    }

    $data = [
        "guess" => $guess,
        "tries" => $tries,
        "number" => $number,
        "res" => $res,
        "doGuess" => $doGuess,
        "doCheat" => $doCheat,

    ];

    return $app->response->redirect("guess/play");
});
