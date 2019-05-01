<!doctype html>
<meta charset="utf-8">
<title>Number Game</title>
<h1>Guess My Number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<form method="post" action="">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start new game">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>

<pre>
<?= var_dump($_POST) ?>
