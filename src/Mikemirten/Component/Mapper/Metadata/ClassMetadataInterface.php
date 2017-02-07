<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

/**
 * Interface of class metadata
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
interface ClassMetadataInterface
{
    /**
     * Get property metadata
     *
     * @param  string $name
     * @return PropertyMetadata
     */
    public function getPropertyMetadata(string $name): PropertyMetadata;

    /**
     * Has metadata for property ?
     *
     * @param  string $name
     * @return bool
     */
    public function hasPropertyMetadata(string $name): bool;
}