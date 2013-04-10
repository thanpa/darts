<?php
require_once 'classes/game.php';
require_once 'classes/player.php';
class GameTest extends PHPUnit_Framework_TestCase
{
    private $_game;
    private $_score;
    private $_player;
    public function setUp()
    {
        $this->_score = 301;
        $this->_game = new Game($this->_score);
        $this->_player = new Player();
        $this->_player->name = 'Thanasis Papapanagiotou';
    }
    public function testGameIsCreated()
    {
        $this->assertEquals(
            $this->_score,
            $this->_game->getInitialScore(),
            'Testing the constructor.'
        );
        $this->assertEquals(
            $this->_score,
            $this->_game->initialScore,
            'Testing the constructor (overloading).'
        );
    }
    public function testSetsPlayerOne()
    {
        $this->_game->setPlayerOne($this->_player);
        $this->assertTrue(
            ($this->_game->playerOne instanceof Player),
            'Check return type'
        );
        $this->assertEquals(
            $this->_player->name,
            $this->_game->playerOne->name,
            'Player name is correct'
        );
    }
    public function testSetsPlayerTwo()
    {
        $this->_game->setPlayerTwo($this->_player);
        $this->assertTrue(
            ($this->_game->playerTwo instanceof Player),
            'Check return type'
        );
        $this->assertEquals(
            $this->_player->name,
            $this->_game->playerTwo->name,
            'Player name is correct'
        );
    }
    public function testSetsInitialScore()
    {
        $this->_game->setInitialScore(701);
        $this->assertEquals(
            701,
            $this->_game->initialScore,
            'Initial score is correct'
        );
    }
    public function testDoesNotAcceptIncorrectInitialScore()
    {
        $this->setExpectedException('Exception');
        $this->_game->setInitialScore(1985);
    }
    public function testIfGameStillOn()
    {
        $this->_game->setPlayerOne($this->_player);
        $this->_game->setPlayerTwo($this->_player);
        $this->_game->playerOne->score = 10;
        $this->_game->playerTwo->score = 10;
        $this->assertTrue($this->_game->stillOn(), 'Game is still on.');
        $this->_game->playerOne->score = 0;
        $this->assertFalse($this->_game->stillOn(), 'Game is finished.');
    }
    public function testWinner()
    {
        $this->_game->setPlayerOne($this->_player);
        $this->_player->name = 'Winner player';
        $this->_game->setPlayerTwo($this->_player);
        $this->_game->playerTwo->score = 0;
        $winner = $this->_game->winner();
        $this->assertTrue(
            ($winner instanceof Player),
            'Check return type'
        );
        $this->assertEquals(
            'Winner player',
            $winner->name,
            'Player name is winner name'
        );
    }
    public function testNext()
    {
        $next = $this->_game->next();
        for ($i = 0; $i < 5; $i++) {
            if ($next == 'playerOne') {
                $expected = 'playerTwo';
            } else {
                $expected = 'playerOne';
            }
            $next = $this->_game->next();
            $this->assertEquals(
                $expected,
                $next,
                'Next switch after end of turn'
            );
        }
    }
}
