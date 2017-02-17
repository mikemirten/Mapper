<?php

namespace Mikemirten\Component\Mapper\Fixture;

class ObjectWithTrait
{
    use PropertyTrait;

    /**
     * @var int
     */
    private $extendedTestProperty;
}