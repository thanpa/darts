<?php
require_once 'classes/entity.php';
/**
 * Dart entity.
 *
 * <p>Describes the dart hit on the dartboard.
 * <p>Holding the multiplier andf the number of the hit,
 * this object can give us the total of each dart on the
 * dartboard.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
class Dart extends Entity
{
    /**
     * Holds the multiplier information of this dart.
     *
     * @var int
     */
    private $_multiplier;
    /**
     * Holds the hit information of this dart.
     *
     * @var int
     */
    private $_hit;
    /**
     * Constructs the dart by providing the hit and multiplier.
     *
     * @param int $hit The hit information.
     * @param int $multiplier The multiplier information.
     *
     * @throws Exception In case the information provided are not accepted.
     */
    public function __construct($hit, $multiplier)
    {
        $correctHit = ($hit == 25) || ($hit == 50) || ($hit >= 0 && $hit <= 20);
        if (!is_numeric($hit) || !$correctHit) {
            throw new Exception('Hit needs to be a number between 0 and 20, 25 or 50.');
        }
        if (!is_numeric($hit) || $multiplier < 1 || $multiplier > 3) {
            throw new Exception('Multiplier needs to be a number between 1 and 3.');
        }
        $this->_hit = $hit;
        $this->_multiplier = $multiplier;
    }
    /**
     * Returns the hit information.
     *
     * @return int The hit information.
     */
    public function getHit()
    {
        return $this->_hit;
    }
    /**
     * Returns the multiplier information.
     *
     * @return string The multiplier information.
     */
    public function getMultiplier()
    {
        return $this->_multiplier;
    }
    /**
     * Returns the points earned in this dart.
     *
     * @return int The points earned in this dart.
     */
    public function points()
    {
        return ($this->_hit * $this->_multiplier);
    }
}
