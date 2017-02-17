<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

/**
 * Interface of property metadata
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
interface PropertyMetadataInterface
{
    /**
     * Get name of property
     *
     * @return string
     */
    public function getName(): string;
}