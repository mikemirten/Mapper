<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Exception;

class PropertyMetadataOverrideException extends MapperException
{
    /**
     * PropertyMetadataOverrideException constructor.
     *
     * @param string     $name
     * @param \Exception $previous
     */
    public function __construct(string $name, \Exception $previous = null)
    {
        $message = sprintf('Property "%s" has been added before.', $name);

        parent::__construct($message, 0, $previous);
    }
}