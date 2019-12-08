<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * エリア (ValueObject)
 */
final class Src
{
    /**
     * @var string src value
     */
    protected $value;

    /**
     * Src constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string src value
     */
    public function value()
    {
        return $this->value;
    }
}
