<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * TextPDF value
 * */
final class Text
{
    /**
     * @var string
     */
    protected $value;

    /**
     * TextPDF constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }
}
