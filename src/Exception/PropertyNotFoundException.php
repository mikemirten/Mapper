<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Exception;

use Mikemirten\Component\Mapper\Metadata\ClassMetadataInterface;

class PropertyNotFoundException extends MapperException
{
    /**
     * PropertyNotFoundException constructor.
     *
     * @param string                 $name
     * @param ClassMetadataInterface $metadata
     * @param \Exception             $previous
     */
    public function __construct(string $name, ClassMetadataInterface $metadata, \Exception $previous = null)
    {
        $message = sprintf(
            'Property "%s" not found inside of "%s" class or has not been assigned for mapping.',
            $name,
            $metadata->getName()
        );

        $properties = $metadata->getPropertiesMetadata();

        if (empty($properties)) {
            $message .= ' Metadata contains no properties.';

            parent::__construct($message, 0, $previous);
            return;
        }

        $available = [];

        foreach ($properties as $property)
        {
            $available [] = $property->getName();
        }

        $message .= sprintf(' Available properties: "%s".', implode('", "', $available));

        parent::__construct($message, 0, $previous);
    }
}