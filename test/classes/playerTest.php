<?php
require_once 'classes/player.php';
class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function testSetAndGetName()
    {
        $player = new Player();
        $player->setName('Thanasis');
        $this->assertEquals('Thanasis', $player->getName(), 'Name is correct');
    }
    public function testSetAndGetScore()
    {
        $player = new Player();
        $player->setScore(100);
        $this->assertEquals(100, $player->getScore(), 'Name is correct');
    }
}
