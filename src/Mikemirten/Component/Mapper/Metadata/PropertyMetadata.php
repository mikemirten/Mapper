<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

/**
 * Container of property metadata
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
class PropertyMetadata implements PropertyMetadataInterface
{
    /**
     * Name of property
     *
     * @var string
     */
    protected $name;

    /**
     * Datatype of property
     *
     * @var string
     */
    protected $type;

    /**
     * PropertyMetadata constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set datatype of property
     *
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Get datatype of property
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Has determined type of property ?
     *
     * @return bool
     */
    public function hasType(): bool
    {
        return $this->type !== null;
    }
}