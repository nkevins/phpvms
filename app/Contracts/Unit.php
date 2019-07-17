<?php

namespace App\Contracts;

use ArrayAccess;

/**
 * Class Unit
 *
 * @property mixed  $instance
 * @property string $unit
 * @property array  $units
 */
class Unit implements ArrayAccess
{
    /**
     * The unit this is kept as
     */
    public $unit;

    /**
     * All of the units of this class
     */
    public $units;

    /**
     * Holds an instance of the PhpUnit type
     */
    protected $instance;

    /**
     * Units that are included as part of the REST response
     */
    public $responseUnits = [];

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->__toString();
    }

    /**
     * Just call toUnit() on the PhpUnitOfMeasure instance
     *
     * @param string $unit
     *
     * @return mixed
     */
    public function toUnit($unit)
    {
        return $this->instance->toUnit($unit);
    }

    /**
     * Return all of the units that get sent back in a response
     */
    public function getResponseUnits(): array
    {
        $response = [];
        foreach ($this->responseUnits as $unit) {
            $response[$unit] = $this[$unit];
        }

        return $response;
    }

    /**
     * Implements ArrayAccess
     *
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->units);
    }

    /**
     * Implements ArrayAccess
     *
     * @param $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return round($this->instance->toUnit($offset), 2);
    }

    /**
     * Implements ArrayAccess
     *
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        // $this->units[$offset] = $value;
    }

    /**
     * Implements ArrayAccess
     *
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        // $this->units[$offset] = null;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return (string) $this->units[$this->unit];
    }
}