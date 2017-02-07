<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Type;

/**
 * Interface of type of data
 *
 * @package Mikemirten\Component\Mapper\Type
 */
interface TypeInterface
{
    /**
     * Convert value to object
     *
     * @param  $value
     * @return mixed
     */
    public function toObject($value);

    /**
     * Convert value from object
     *
     * @param  $value
     * @return mixed
     */
    public function fromObject($value);
}