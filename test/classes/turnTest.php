<?php
require_once 'classes/turn.php';
require_once 'classes/player.php';
class TurnTest extends PHPUnit_Framework_TestCase
{
    public function testFunctionsAsIntended()
    {
        $player = new Player();
        $turn = new Turn($player);
        $dart = new Dart(10, 1);
        for ($i = 1; $i <= Turn::DARTS_PER_TURN; $i++) {
            $turn->dart($dart);
            $this->assertEquals(
                (Turn::DARTS_PER_TURN - $i),
                $turn->throwsLeft(),
                'Throws left are calculated correctly'
            );
        }
        $this->assertEquals(30, $turn->total(), 'Total is calculated correctly');
        $this->assertTrue($turn->ended(), Turn::DARTS_PER_TURN.' darts was thrown and turn ended.');
    }
    public function testBust()
    {
        $player = new Player();
        $player->setScore(100);
        $turnOne = new Turn($player);
        $turnOne->dart(new Dart(20, 3));
        $turnOne->dart(new Dart(10, 1));
        $turnOne->dart(new Dart(5, 1));
        $this->assertEquals(75, $turnOne->total(), 'Total is calculated correctly.');
        $this->assertFalse($turnOne->bust(), 'User should not be bust (25 points left).');
        $turnTwo = new Turn($player);
        $turnTwo->dart(new Dart(20, 3));
        $turnTwo->dart(new Dart(19, 2));
        $turnTwo->dart(new Dart(1, 1));
        $this->assertEquals(99, $turnTwo->total(), 'Total is calculated correctly.');
        $this->assertTrue($turnTwo->bust(), 'User should be bust (1 left).');
        $turnThree = new Turn($player);
        $turnThree->dart(new Dart(20, 3));
        $turnThree->dart(new Dart(20, 2));
        $turnThree->dart(new Dart(20, 1));
        $this->assertEquals(120, $turnThree->total(), 'Total is calculated correctly.');
        $this->assertTrue($turnThree->bust(), 'User should be bust (-20 left).');
        $turnFour = new Turn($player);
        $turnFour->dart(new Dart(20, 3));
        $turnFour->dart(new Dart(20, 2));
        $turnFour->dart(new Dart(20, 1));
        $this->assertEquals(120, $turnFour->total(), 'Total is calculated correctly.');
        $this->assertTrue($turnFour->bust(), 'User should be bust (0 left but no double).');
        $turnFive = new Turn($player);
        $turnFive->dart(new Dart(20, 2));
        $turnFive->dart(new Dart(20, 1));
        $turnFive->dart(new Dart(20, 2));
        $this->assertEquals(100, $turnFive->total(), 'Total is calculated correctly.');
        $this->assertFalse($turnFive->bust(), 'User should not be bust (0 points left).');
    }
}
