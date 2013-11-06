<?php
namespace Chart;

class Row
{
    private
        $_cells = array();

    public function setCell(Cell $cell)
    {
        $this->_cells[(string)$cell->getColumn()] = $cell;
        ksort($this->_cells);

        return $this;
    }

    public function getCells()
    {
        return $this->_cells;
    }
}

