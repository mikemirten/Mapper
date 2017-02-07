<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper;

use Mikemirten\Component\Mapper\Accessor\AccessorInterface;
use Mikemirten\Component\Mapper\Metadata\ProviderInterface;
use Mikemirten\Component\Mapper\Type\TypeRepository;

/**
 * The object mapper
 *
 * @package Mikemirten\Component\Mapper
 */
class ObjectMapper
{
    /**
     * Property accessor
     *
     * @var AccessorInterface
     */
    protected $accessor;

    /**
     * Metadata provider
     *
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * Repository od types of data
     *
     * @var TypeRepository
     */
    protected $typeRepository;

    /**
     * ObjectMapper constructor.
     *
     * @param AccessorInterface $accessor       Property accessor
     * @param ProviderInterface $provider       Metadata provider
     * @param TypeRepository    $typeRepository Repository of types of data
     */
    public function __construct(AccessorInterface $accessor, ProviderInterface $provider, TypeRepository $typeRepository)
    {
        $this->accessor       = $accessor;
        $this->provider       = $provider;
        $this->typeRepository = $typeRepository;
    }

    /**
     * Set data to object
     *
     * @param $object
     * @param array $data
     */
    public function set($object, array $data)
    {

    }

    /**
     * Get data from object
     *
     * @param  $object
     * @return array
     */
    public function get($object): array
    {

    }
}