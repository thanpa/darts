<?php
/**
 * Console entity.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
class Console
{
    /**
     * Holds the stdin stream.
     *
     * @var resource The file pointer resource.
     */
    private $_stdin;
    /**
     * Constructs the console object by opening the stdin.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_stdin = fopen('php://stdin', 'r');
    }
    /**
     * Destructs the console object by closing the stdin.
     *
     * @return void
     */
    public function __destruct()
    {
        fclose($this->_stdin);
    }
    /**
     * Reads the input from the user.
     *
     * @return string The user input.
     */
    public function read()
    {
        return trim(fgets($this->_stdin, 1024), "\r\n");
    }
}