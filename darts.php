<?php
require_once 'classes/game.php';
require_once 'classes/player.php';
require_once 'classes/turn.php';
require_once 'classes/dart.php';
require_once 'classes/console.php';
$console = new Console();
$game = new Game();
// Get the two player names of this game!
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
// Start the game and run until there is a winner.
while ($game->stillOn()) {
    $next = $game->next();
    echo "Next is {$game->$next->name}.\n";
    echo "{$game->$next->name} needs {$game->$next->score} to win.\n";
    echo sprintf(
        "It's %spossible to finish in this turn.\n",
        ($game->$next->score <= 170) ? '' : 'not '
    );
    $turn = new Turn($game->$next);
    // Keep gettng darts until the turn is ended.
    while(!$turn->ended()) {
        echo 'Dart hit: ';
        // Get the value of the user.
        // Keep in mind that the user can type a number
        // or a number and a multiplier. Eg:
        // 20 or 3x20
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
    // Check if the user gone bust in this turn.
    if (!$turn->bust()) {
        echo "Not a bust ";
        $game->$next->score = ($game->$next->score - $turn->total());
        echo "New score = {$game->$next->score}\n";
    } else {
        echo "Bust\n";
    }
}
echo sprintf("And the winner is: %s!\n", $game->winner()->name);