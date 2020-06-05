<?php

declare(strict_types=1);

namespace Arg2009\Selectel\Entities\Http\Request;

use Arg2009\Selectel\Entities\AbstractEntity;

abstract class AbstractRequestEntity extends AbstractEntity
{
    // All request entities should convert to json
    abstract public function __toString(): string;
}
