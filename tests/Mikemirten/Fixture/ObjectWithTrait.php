<?php

namespace Mikemirten\Fixture;

class ObjectWithTrait
{
    use PropertyTrait;

    /**
     * @var int
     */
    private $extendedTestProperty;
}