<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

use Mikemirten\Component\Mapper\Fixture\ExtendedPropertyObject;
use Mikemirten\Component\Mapper\Fixture\ObjectWithTrait;
use Mikemirten\Component\Mapper\Fixture\PropertyObject;
use PHPUnit\Framework\TestCase;

class SimplePropertiesProviderTest extends TestCase
{
    public function testBasics()
    {
        $object   = new PropertyObject();
        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $this->assertTrue($metadata->hasPropertyMetadata('testProperty'));
        $this->assertFalse($metadata->hasPropertyMetadata('middleName'));
        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('testProperty'));
    }

    /**
     * @expectedException \Mikemirten\Component\Mapper\Exception\PropertyNotFoundException
     */
    public function testNotFound()
    {
        $object   = new PropertyObject();
        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $metadata->getPropertyMetadata('lastName');
    }

    public function testExtended()
    {
        $object = new ExtendedPropertyObject();

        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $this->assertTrue($metadata->hasPropertyMetadata('testProperty'));
        $this->assertTrue($metadata->hasPropertyMetadata('extendedTestProperty'));

        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('testProperty'));
        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('extendedTestProperty'));
    }

    public function testTrait()
    {
        $object = new ObjectWithTrait();

        $provider = new SimplePropertiesProvider();
        $metadata = $provider->getClassMetadata(new \ReflectionClass($object));

        $this->assertTrue($metadata->hasPropertyMetadata('testProperty'));
        $this->assertTrue($metadata->hasPropertyMetadata('extendedTestProperty'));

        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('testProperty'));
        $this->assertInstanceOf(PropertyMetadata::class, $metadata->getPropertyMetadata('extendedTestProperty'));
    }
}