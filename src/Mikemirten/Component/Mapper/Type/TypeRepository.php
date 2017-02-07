<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Type;

/**
 * Repository of types of data
 *
 * @package Mikemirten\Component\Mapper\Type
 */
class TypeRepository
{
    /**
     * Registered types of data
     *
     * @var TypeInterface[]
     */
    protected $types = [];

    /**
     * Register type with name
     *
     * Name must be unique, but one type can be registered more than once with different names.
     * It can be useful in case of aliases. Like "float", "double".
     *
     * @param string        $name
     * @param TypeInterface $type
     */
    public function register(string $name, TypeInterface $type)
    {

    }

    /**
     * Contains type with name ?
     *
     * @param  string $name
     * @return bool
     */
    public function has(string $name): bool
    {

    }

    /**
     * Get type by name
     *
     * @param  string $name
     * @return TypeInterface
     */
    public function get(string $name): TypeInterface
    {

    }

    /**
     * Get all registered types
     *
     * @return TypeInterface[] ["name" => TypeInterface]
     */
    public function all(): array
    {

    }
}