<?php
require_once 'classes/dart.php';
class DartTest extends PHPUnit_Framework_TestCase
{
    public function testPoints()
    {
        $dartTestOne = new Dart(10, 1);
        $this->assertEquals(10, $dartTestOne->points());
        $dartTestTwo = new Dart(10, 2);
        $this->assertEquals(20, $dartTestTwo->points());
        $dartTestTree = new Dart(10, 3);
        $this->assertEquals(30, $dartTestTree->points());
    }
    public function testThrowsWhenIncorrectHit()
    {
        $this->setExpectedException('Exception');
        new Dart(21, 1);
    }
    public function testThrowsWhenIncorrectMultiplier()
    {
        $this->setExpectedException('Exception');
        new Dart(10, 4);
    }
}
