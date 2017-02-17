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
     * Get name of class
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get property metadata
     *
     * @param  string $name
     * @return PropertyMetadataInterface
     */
    public function getPropertyMetadata(string $name): PropertyMetadataInterface;

    /**
     * Has metadata for property ?
     *
     * @param  string $name
     * @return bool
     */
    public function hasPropertyMetadata(string $name): bool;

    /**
     * Get metadata of all properties
     *
     * @return PropertyMetadataInterface[]
     */
    public function getPropertiesMetadata(): array;
}