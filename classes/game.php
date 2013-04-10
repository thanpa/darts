<?php
require_once 'classes/entity.php';
/**
 * Game entity.
 *
 * <p>This is the main heart of the game.
 * <p>Holding the two players and the game type (301 or 501
 * or even 701, 1001 in case the players are actually teams.)
 * desides who is the winner of the current game and if the
 * game is still on or not.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
class Game extends entity
{
    /**
     * Holds the initial score of the game (game type).
     *
     * @var int
     */
    private $_initialScore;
    /**
     * Holds the first player to play the game.
     *
     * @var Player
     */
    private $_playerOne;
    /**
     * Holds the second player to play the game.
     *
     * @var Player
     */
    private $_playerTwo;
    /**
     * Holds the variable name of the next player.
     *
     * @var string
     */
    private $_next;
    /**
     * Constructs the game.
     *
     * @param int $initialScore The initial score of the game (game type).
     * @throws Exception In case the initial score is not acceptable.
     * @return void
     */
    public function __construct($initialScore = 501)
    {
        $this->setInitialScore($initialScore);
        $this->_next = 'playerTwo';
    }
    /**
     * Returns the player one.
     *
     * @return Player The first player.
     */
    public function getPlayerOne()
    {
        return $this->_playerOne;
    }
    /**
     * Returns the player two.
     *
     * @return Player The second player.
     */
    public function getPlayerTwo()
    {
        return $this->_playerTwo;
    }
    /**
     * Returns the initial score.
     *
     * @return int
     */
    public function getInitialScore()
    {
        return $this->_initialScore;
    }
    /**
     * Sets the player one.
     *
     * @return void
     */
    public function setPlayerOne($player)
    {
        $this->_playerOne = $player;
    }
    /**
     * Sets the player two.
     *
     * @return void
     */
    public function setPlayerTwo($player)
    {
        $this->_playerTwo = $player;
    }
    /**
     * Sets the initial score.
     *
     * @return void
     */
    public function setInitialScore($score)
    {
        $acceptable = array(301, 501, 701, 1001);
        if (!in_array($score, $acceptable)) {
            throw new Exception(
                sprintf(
                    'The initial score specified is not acceptable, please try %s',
                    implode(', ', $acceptable)
                )
            );
        }
        $this->_initialScore = $score;
    }
    /**
     * Checks if the game is still going on.
     *
     * @return boolean If the game is finished or not.
     */
    public function stillOn()
    {
        $thereIsWinner = false;
        if ($this->_playerOne->score == 0) {
            $thereIsWinner = true;
        } else if ($this->_playerTwo->score == 0) {
            $thereIsWinner = true;
        }
        return !$thereIsWinner;
    }
    /**
     * Returns the winner player entity.
     *
     * @return \Player
     */
    public function winner()
    {
        if ($this->_playerOne->score == 0) {
            $winner = $this->_playerOne;
        } else if ($this->_playerTwo->score == 0) {
            $winner = $this->_playerTwo;
        } else {
            $winner = new Player();
        }
        return $winner;
    }
    /**
     * Sets and returns the name of the variable holding the next player.
     *
     * @return string The name of the variable holding the next player.
     */
    public function next()
    {
        $this->_next = ($this->_next != 'playerOne') ? 'playerOne' : 'playerTwo';
        return $this->_next;
    }
}
