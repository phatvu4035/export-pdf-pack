<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Ln value
 */
final class Align
{
    /**
     * @var string align value
     */
    protected $value;

    /**
     * @var array allowed value
     */
    private $allowedValue = ['L', 'C', 'R', 'J', ''];

    /**
     * Align constructor.
     * @param  string     $value
     * @throws \Exception
     */
    public function __construct(string $value)
    {
        if (!in_array($value, $this->allowedValue)) {
            throw new \Exception('Value must be one of the value L, R, C, J or leave empty.');
        }
        $this->value = $value;
    }

    /**
     * @return string align value
     */
    public function value()
    {
        return $this->value;
    }
}
