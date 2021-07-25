<?php
declare(strict_types=1);

namespace AsciiTable;

class Cell implements CellInterface
{
    /**
     * int
     */
    public const ALIGN_LEFT = 0;

    /**
     * int
     */
    public const ALIGN_RIGHT = 1;

    /**
     * The name of the column that the cell belongs to
     *
     * @var string
     */
    private string $columnName;

    /**
     * @var string
     */
    private string $value;

    /**
     * @var int
     */
    private int $align = self::ALIGN_LEFT;

    /**
     * @var int
     */
    private int $width = 0;

    public function __construct($columnName, $value = '')
    {
        $this->setColumnName($columnName);
        $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(mixed $value): void
    {
        if (is_float($value)) {
            $round = round($value);
            if (($value - $round) === (float)0) {
                $this->value = number_format($value, 2, '.', ' ');
            } else {
                $this->value = (string)$value;
            }
            $this->align = self::ALIGN_RIGHT;
        } elseif (is_int($value)) {
            $this->value = (string)$value;
            $this->align = self::ALIGN_RIGHT;
        } else {
            $this->value = (string)$value;
            $this->align = self::ALIGN_LEFT;
        }

        $this->width = mb_strwidth($this->value);
    }

    public function getAlign(): int
    {
        return $this->align;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * {@inheritdoc}
     */
    public function setColumnName(string $columnName): void
    {
        $this->columnName = $columnName;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth(): int
    {
        return $this->width;
    }
}
