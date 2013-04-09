<?php
require_once 'classes/game.php';
require_once 'classes/player.php';
require_once 'classes/turn.php';
require_once 'classes/dart.php';
require_once 'classes/console.php';
$console = new Console();
$game = new Game();
$playerOne = new Player();
echo "Please provide player's one name:\n";
$playerOne->name = $console->read();
$playerOne->score = $game->initialScore;
$game->playerOne = $playerOne;
$playerTwo = new Player();
echo "Please provide player's two name:\n";
$playerTwo->name = $console->read();
$playerTwo->score = $game->initialScore;
$game->playerTwo = $playerTwo;
while ($game->stillOn()) {
    $next = $game->next();
    echo "Next is {$game->$next->name}.\n";
    echo "{$game->$next->name} needs {$game->$next->score} to win.\n";
    echo sprintf(
        "It's %spossible to finish in this turn.\n",
        ($game->$next->score <= 170) ? '' : 'not '
    );
    $turn = new Turn($game->$next);
    while(!$turn->ended()) {
        echo 'Dart hit: ';
        $input = $console->read();
        $explodedInput = explode('x', $input);
        if (count($explodedInput) == 2) {
            $hit = trim($explodedInput[1]);
            $multiplier = trim($explodedInput[0]);
        } else {
            $hit = trim($explodedInput[0]);
            $multiplier = 1;
        }
        $dart = new Dart($hit, $multiplier);
        $turn->dart($dart);
    }
    if (!$turn->bust()) {
        echo "Not a bust ";
        $game->$next->score = ($game->$next->score - $turn->total());
        echo "New score = {$game->$next->score}\n";
    } else {
        echo "Bust\n";
    }
}
echo sprintf("And the winner is: %s!\n", $game->winner()->name);