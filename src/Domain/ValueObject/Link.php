<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Link value
 */
final class Link
{
    /**
     * @var string link value
     */
    protected $value;

    /**
     * Link constructor.
     * @param string $value
     */
    public function __construct(string $value = '')
    {
        $this->value = $value;
    }

    /**
     * @return string link value
     */
    public function value()
    {
        return $this->value;
    }
}
