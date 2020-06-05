<?php

namespace Arg2009\Selectel\Entities;

abstract class AbstractEntity implements EntityInterface
{
    /**
     * Force Data Entities as read only by default.
     *
     * @param $name
     * @param $value
     * @return
     * @throws EntityException
     */
    public function __set($name, $value)
    {
        $setterMethodName = 'set' . ucfirst($name);
        if (method_exists($this, $setterMethodName)) {
            return $this->{$setterMethodName}($value);
        }

        throw new EntityException('Data Entities are ready only by default. Define a setter to allow manipulating fields.');
    }

    /**
     * Grant Read Only access to the properties by default.
     *
     * @param $name
     * @return mixed
     * @throws EntityException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new EntityException('Property does not exist.');
    }
}
