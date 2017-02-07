<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;

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
     * @return ClassMetadata
     */
    public function getClassMetadata(\ReflectionClass $reflection): ClassMetadata;
}