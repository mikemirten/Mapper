<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Accessor;

use Mikemirten\Component\Mapper\Metadata\PropertyMetadataInterface;
use PHPUnit\Framework\TestCase;

class ReflectionAccessorTest extends TestCase
{
    public function testSetToPublic()
    {
        $object = new class
        {
            public $firstName;
        };

        $accessor = new ReflectionAccessor();
        $accessor->set($object, 'John', $this->createPropertyMetadata('firstName'));

        $this->assertSame('John', $object->firstName);
    }

    public function testSetToPrivate()
    {
        $object = new class
        {
            private $firstName;

            public function getFirstName(): string
            {
                return $this->firstName;
            }
        };

        $accessor = new ReflectionAccessor();
        $accessor->set($object, 'John', $this->createPropertyMetadata('firstName'));

        $this->assertSame('John', $object->getFirstName());
    }

    public function testGetFromPublic()
    {
        $object = new class
        {
            public $firstName = 'John';
        };

        $accessor  = new ReflectionAccessor();
        $firstName = $accessor->get($object, $this->createPropertyMetadata('firstName'));

        $this->assertSame('John', $firstName);
    }

    public function testGetFromPrivate()
    {
        $object = new class
        {
            private $firstName = 'John';
        };

        $accessor  = new ReflectionAccessor();
        $firstName = $accessor->get($object, $this->createPropertyMetadata('firstName'));

        $this->assertSame('John', $firstName);
    }

    /**
     * Create mock of property metadata
     *
     * @param  string $name
     * @return PropertyMetadataInterface
     */
    protected function createPropertyMetadata(string $name): PropertyMetadataInterface
    {
        $metadata = $this->createMock(PropertyMetadataInterface::class);

        $metadata->expects($this->once())
            ->method('getName')
            ->willReturn($name);

        return $metadata;
    }
}