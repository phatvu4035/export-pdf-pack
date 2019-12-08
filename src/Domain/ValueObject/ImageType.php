<?php

declare(strict_types = 1);

namespace Dotcm\ExportPDF\Domain\ValueObject;

/**
 * Type value
 */
class ImageType
{
    /**
     * @var string type value
     */
    protected $value;

    private $validImageType = ['JPEG', 'JPG', 'GIF', 'PNG', ''];

    /**
     * ImageType constructor.
     * @param  string     $value
     * @throws \Exception
     */
    public function __construct(string $value = '')
    {
        if (!in_array($value, $this->validImageType)) {
            throw new \Exception('Value must be one of the value  JPG, JPEG, PNG, GIF or leave empty.');
        }
        $this->value = $value;
    }

    /**
     * @return string image type
     */
    public function value()
    {
        return $this->value;
    }
}
