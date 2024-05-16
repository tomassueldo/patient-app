<?php

namespace App\DTO;


use JsonSerializable;


abstract class BaseDto implements JsonSerializable
{


    /**
     * BaseDto constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }


    /**
     * Fill the model with an array of attributes.
     *
     * @param array $attributes
     * @return $this
     */
    protected function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key) && $value !== null) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }


    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /**
     * @param array $params
     * @return $this
     */
    public function hide($params = [])
    {
        if (is_array($params) && count($params) > 0) {
            foreach ($params as $key => $value) {
                unset($this->{$key});
            }
        }


        return $this;
    }


    /**
     * @return $this
     */
    public function hideNull()
    {
        foreach (get_object_vars($this) as $key => $value) {
            if ($value === null) {
                unset($this->{$key});
            }
        }


        return $this;
    }


    public function toArray()
    {
        return get_object_vars($this);
    }
}
