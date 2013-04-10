<?php
/**
 * Entity abstraction.
 *
 * <p>In this abstract class is the implementation of
 * getters and setters for all entities in the system.
 *
 * @author Thanasis Papapanagiotou <hello@thanpa.com>
 * @copyright (c) 2013, thanpa.com
 */
abstract class Entity
{
    /**
     * Gets the entity variable if available.
     *
     * @param string $property The property needed.
     * @return mixed The property value, type depends on the property.
     * @throws Exception In case the property doesn't exist.
     */
    public function __get($property)
    {
        $method = sprintf('get%s', ucfirst((string)$property));
        if (!is_callable(array($this, $method))) {
            throw new Exception($this, (string)$property);
        }
        return $this->$method();
    }
    /**
     * Sets the entity variable if possible.
     *
     * @param string $property The property to change.
     * @param string $value The value to set.
     * @return mixed The property value, type depends on the property.
     * @throws Exception In case the property doesn't exist.
     */
    public function __set($property, $value)
    {
        $method = sprintf('set%s', ucfirst((string)$property));
        if (!is_callable(array($this, $method))) {
            throw new Exception($this, (string)$property);
        }
        return $this->$method($value);
    }
}
