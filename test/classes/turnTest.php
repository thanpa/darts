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
    /**
     * @dataProvider turns
     */
    public function testBust($expected, $dartOne, $dartTwo, $dartThree)
    {
        $player = new Player();
        $player->setScore(100);
        $turn = new Turn($player);
        $turn->dart($dartOne);
        $turn->dart($dartTwo);
        $turn->dart($dartThree);
        $this->assertEquals($expected, $turn->bust());
    }
    public function turns()
    {
        return array(
            array(false, new Dart(20, 3), new Dart(10, 1), new Dart(5, 1)),
            array(true, new Dart(20, 3), new Dart(19, 2), new Dart(1, 1)),
            array(true, new Dart(20, 3), new Dart(20, 2), new Dart(20, 3)),
            array(true, new Dart(20, 3), new Dart(20, 2), new Dart(20, 1)),
            array(false, new Dart(20, 2), new Dart(20, 1), new Dart(20, 2)),
        );
    }
}
