<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Class FontWeigth value
 * @package Dotcm\ExportPDF\Domain\ValueObject
 */
final class FontWeigth
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var array allowed value for font weight
     */
    private $allowedValue = ['', 'B', 'I', 'U'];

    /**
     * FontWeigth constructor.
     * @param $value
     * @throws \Exception
     */
    public function __construct(string $value = '')
    {
        if (!in_array($value, $this->allowedValue)) {
            throw new \Exception('Value must be one of the value B, I, U or leave empty.');
        }
        $this->value = $value;
    }

    /**
     * @return string font weight value
     */
    public function value()
    {
        return $this->value;
    }
}
