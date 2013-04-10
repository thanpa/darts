<?php
require_once 'classes/entity.php';
/**
 * Turn entity.
 *
 * <p>Each time a player has their turn, this object
 * is initialized.
 * <p>The system will create as many objects as the
 * turns needed to finish the game.
 * <p>In this object is also the logic of if the player
 * gone bust form his hits or not.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
class Turn extends Entity
{
    /**
     * How many darts per round.
     */
    const DARTS_PER_TURN = 3;
    /**
     * Holds the darts that have been thrown in this turn.
     *
     * @var array
     */
    private $_darts;
    /**
     * Holds the player playing this turn.
     *
     * @var Player
     */
    private $_player;
    /**
     * Constructs the turn by setting the player.
     *
     * @param Player $player The player of this turn.
     */
    public function __construct(Player $player)
    {
        $this->_player = $player;
    }
    /**
     * Sets a new dart thrown in this turn.
     *
     * @param Dart $dart The dart thrown.
     */
    public function dart(Dart $dart)
    {
        $this->_darts[] = $dart;
    }
    /**
     * Checks and returns if this turn is ended or not.
     *
     * @return boolean If the turn is ended or not.
     */
    public function ended()
    {
        return (count($this->_darts) == self::DARTS_PER_TURN);
    }
    /**
     * Checks and returns how many throws are left for this turn.
     *
     * @return int The number of throws left.
     */
    public function throwsLeft()
    {
        return (self::DARTS_PER_TURN - count($this->_darts));
    }
    /**
     * Returns the total score gained in this turn.
     *
     * @return int The total score gained.
     */
    public function total()
    {
        $total = 0;
        foreach ($this->_darts as $dart) {
            $total += $dart->points();
        }
        return $total;
    }
    /**
     * Checks and returns if the player gone bust with this turn.
     *
     * @return boolean If the player gone bust with this turn.
     */
    public function bust()
    {
        $bust = false;
        $pointsLeft = ($this->_player->score - $this->total());
        $lastDart = $this->_darts[(count($this->_darts)-1)];
        if ($pointsLeft < 0 || $pointsLeft == 1) {
            $bust = true;
        } else if ($pointsLeft == 0) {
            if ($lastDart->multiplier != 2) {
                if ($lastDart->hit != 50) {
                    $bust = true;
                }
            }
        }
        return $bust;
    }
}
