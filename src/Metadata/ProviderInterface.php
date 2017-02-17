<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

/**
 * Interface of metadata provider
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
interface ProviderInterface
{
    /**
     * Get metadata for class
     *
     * @param  \ReflectionClass $reflection
     * @return ClassMetadataInterface
     */
    public function getClassMetadata(\ReflectionClass $reflection): ClassMetadataInterface;
}