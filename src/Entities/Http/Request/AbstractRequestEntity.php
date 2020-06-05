<?php

declare(strict_types=1);

namespace Arg2009\Selectel\Client\Entities\Http\Request;

use Arg2009\Selectel\Client\Entities\AbstractEntity;

abstract class AbstractRequestEntity extends AbstractEntity
{
    // All request entities should convert to json
    abstract public function __toString(): string;
}
