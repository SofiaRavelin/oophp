<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Guess My Number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<form method="post" action="">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Make a guess"
    <?php if ($guess == $_SESSION["number"] || $tries == 0) { echo 'disabled';
    }
    ?>>
    <input type="submit" name="doInit" value="Start new game">
    <input type="submit" name="doCheat" value="Cheat"
    <?php if ($guess == $_SESSION["number"] || $tries == 0) { echo 'disabled';
    }
    ?>>
</form>

<?php if ($res) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $_SESSION["number"] ?>.</p>
<?php endif; ?>

<pre>
<?= var_dump($_POST) ?>
