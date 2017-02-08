<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper;

use Mikemirten\Component\Mapper\Accessor\AccessorInterface;
use Mikemirten\Component\Mapper\Metadata\ClassMetadataInterface;
use Mikemirten\Component\Mapper\Metadata\PropertyMetadataInterface;
use Mikemirten\Component\Mapper\Metadata\ProviderInterface;
use PHPUnit\Framework\TestCase;

class ObjectMapperTest extends TestCase
{
    public function testSet()
    {
        $provider = $this->createProvider('stdClass', ['firstName', 'lastName'], true);
        $accessor = $this->createAccessor('stdClass', [
            'firstName' => 'Joe',
            'lastName'  => 'Doe'
        ], true);

        $mapper = new ObjectMapper($accessor, $provider);

        $mapper->set(new \stdClass(), [
            'firstName' => 'Joe',
            'lastName'  => 'Doe'
        ]);
    }

    public function testGet()
    {
        $provider = $this->createProvider('stdClass', ['firstName', 'lastName']);
        $accessor = $this->createAccessor('stdClass', [
            'firstName' => 'Joe',
            'lastName'  => 'Doe'
        ]);

        $mapper = new ObjectMapper($accessor, $provider);

        $this->assertSame(
            [
                'firstName' => 'Joe',
                'lastName'  => 'Doe'
            ],
            $mapper->get(new \stdClass())
        );
    }

    /**
     * Create mock of accessor
     *
     * @param  string $class     Expected class
     * @param  array $properties Expected properties and values [property => value]
     * @param  bool  $setMode    Test case (set/get)
     * @return AccessorInterface
     */
    protected function createAccessor(string $class, array $properties, bool $setMode = false): AccessorInterface
    {
        $accessor = $this->createMock(AccessorInterface::class);
        $offset   = 0;

        // Different expectations for different cases
        if ($setMode) {
            foreach ($properties as $name => $value)
            {
                $accessor->expects($this->at($offset ++))
                    ->method('set')
                    ->with(
                        $this->isInstanceOf($class),
                        $value,
                        $this->isInstanceOf(PropertyMetadataInterface::class)
                    )
                    ->willReturnCallback(function($object, $value, PropertyMetadataInterface $property) use($name) {
                        $this->assertSame($name, $property->getName());
                    });
            }

            return $accessor;
        }

        foreach ($properties as $name => $value)
        {
            $accessor->expects($this->at($offset ++))
                ->method('get')
                ->with(
                    $this->isInstanceOf($class),
                    $this->isInstanceOf(PropertyMetadataInterface::class)
                )
                ->willReturnCallback(function($object, PropertyMetadataInterface $property) use($name, $value) {
                    $this->assertSame($name, $property->getName());
                    return $value;
                });
        }

        return $accessor;
    }

    /**
     * Create mock of metadata provider
     *
     * @param  string $class      Expected class
     * @param  array  $properties List of properties [prop1, prop2, propN...]
     * @param  bool   $setMode    Test case (set/get)
     * @return ProviderInterface
     */
    protected function createProvider(string $class, array $properties, bool $setMode = false): ProviderInterface
    {
        $metadata = $this->createClassMetadata($properties, $setMode);
        $provider = $this->createMock(ProviderInterface::class);

        $provider->expects($this->once())
            ->method('getClassMetadata')
            ->with($this->isInstanceOf('ReflectionClass'))
            ->willReturnCallback(function(\ReflectionClass $reflection) use($class, $metadata) {
                $this->assertSame($class, $reflection->getName());
                return $metadata;
            });

        return $provider;
    }

    /**
     * Create mock of class metadata
     *
     * @param  array $properties List of properties [prop1, prop2, propN...]
     * @param  bool  $setMode    Test case (set/get)
     * @return ClassMetadataInterface
     */
    protected function createClassMetadata(array $properties, bool $setMode = false): ClassMetadataInterface
    {
        $metadata = $this->createMock(ClassMetadataInterface::class);

        // Different expectations for different cases
        if (! $setMode) {
            $metadata->expects($this->once())
                ->method('getPropertiesMetadata')
                ->willReturn(array_map([$this, 'createPropertyMetadata'], $properties));

            return $metadata;
        }

        foreach ($properties as $offset => $property)
        {
            $metadata->expects($this->at($offset))
                ->method('getPropertyMetadata')
                ->with($property)
                ->willReturn($this->createPropertyMetadata($property));
        }

        return $metadata;
    }

    /**
     * Create mock of property metadata
     *
     * @param  string $property
     * @return PropertyMetadataInterface
     */
    protected function createPropertyMetadata(string $property): PropertyMetadataInterface
    {
        $propertyMetadata = $this->createMock(PropertyMetadataInterface::class);

        $propertyMetadata->method('getName')
            ->willReturn($property);

        return $propertyMetadata;
    }
}