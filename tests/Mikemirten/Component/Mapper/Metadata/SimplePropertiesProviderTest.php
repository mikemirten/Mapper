<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

use PHPUnit\Framework\TestCase;

class SimplePropertiesProviderTest extends TestCase
{
    public function testBasics()
    {
        $object = new class
        {
            private $firstName;
        };

        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $this->assertTrue($metadata->hasPropertyMetadata('firstName'));
        $this->assertFalse($metadata->hasPropertyMetadata('middleName'));
        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('firstName'));
    }

    /**
     * @expectedException \Mikemirten\Component\Mapper\Exception\PropertyNotFoundException
     */
    public function testNotFound()
    {
        $object = new class
        {
            private $firstName;
        };

        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $metadata->getPropertyMetadata('lastName');
    }
}