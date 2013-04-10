<?php
require_once 'classes/entity.php';
/**
 * Player entity.
 *
 * <p>The player entity holds some information about the
 * player.
 * <p> This information are the name and the score left
 * for winning the game. The score is set from the game
 * when in starts.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
class Player extends Entity
{
    /**
     * Holds the score of this player.
     *
     * @var int
     */
    private $_score;
    /**
     * Holds the name of this player.
     *
     * @var string
     */
    private $_name;
    /**
     * Returns the player score.
     *
     * @return int The player score.
     */
    public function getScore()
    {
        return $this->_score;
    }
    /**
     * Returns the player name.
     *
     * @return string The player name.
     */
    public function getName()
    {
        return $this->_name;
    }
    /**
     * Sets the player score.
     *
     * @return void
     */
    public function setScore($score)
    {
        $this->_score = $score;
    }
    /**
     * Sets the player name.
     *
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
    }
}
