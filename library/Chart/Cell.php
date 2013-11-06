<?php
namespace Chart;

class Cell
{
    public
        $label,
        $value;

    private
        $_column;

    public function __construct(Column $column, $value, $label = null)
    {
        $this->_column = $column;
        $this->value = $value;
        $this->label = $label;

        return $this;
    }

    public function getColumn()
    {
        return $this->_column;
    }
}

