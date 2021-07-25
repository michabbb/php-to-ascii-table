<?php declare(strict_types=1);

namespace AsciiTable;

use Ds\Collection;
use Ds\Map;

class Row implements RowInterface
{
    private Map $cells;

    public function __construct()
    {
        $this->cells = new Map();
    }

    /**
     * {@inheritdoc}
     */
    public function addCell(CellInterface $cell): void
    {
        $this->cells->put($cell->getColumnName(), $cell);
    }

    /**
     * {@inheritdoc}
     */
    public function addCells(CellInterface ...$cells):void
    {
        foreach ($cells as $cell) {
            $this->addCell($cell);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCell($columnName) : CellInterface
    {
        return $this->cells->get($columnName);
    }

    /**
     * {@inheritdoc}
     */
    public function hasCell($columnName) : bool
    {
        return $this->cells->hasKey($columnName);
    }

    /**
     * {@inheritdoc}
     */
    public function getCells() : Collection
    {
        return $this->cells;
    }
}
