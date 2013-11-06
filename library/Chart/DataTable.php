<?php
namespace Chart;

class DataTable
{
    private
        $_columns = array(),
        $_rows = array();

    public function addColumn(Column $column)
    {
        if (array_key_exists((string)$column, $this->_columns)) {
            throw new \InvalidArgumentException(
                "Column with label '$column' already exists!"
            );
        }
        $this->_columns[(string)$column] = $column;
        ksort($this->_columns);

        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function insertRow(Row $row)
    {
        $this->_rows []= $row;

        return $this;
    }

    public function getRows()
    {
        return $this->_rows;
    }

    public function toJson()
    {
        $json = new stdClass;

        $json->cols = array();
        foreach ($this->_columns as $column) {
            $jsonCol = new stdClass;
            $jsonCol->id = $column->getId();
            $jsonCol->label = $column->getLabel();
            $jsonCol->type = $column->getType();
            $json->cols []= $jsonCol;
        }

        $json->rows = array();
        foreach ($this->_rows as $row) {
            $jsonRow = new stdClass;
            $jsonRow->c = array();
            $cells = $row->getCells();
            foreach ($this->_columns as $column) {
                $jsonCell = null;
                if (array_key_exists($column, $cells)) {
                    $jsonCell = new stdClass;
                    $jsonCell->v = $cells[$column]->value;
                    if (isset($cells[$column]->label)) {
                        $jsonCell->f = $cells[$column]->label;
                    }
                }
                $jsonRow->c []= $jsonCell;
            }
            $json->rows []= $jsonRow;
        }

        return json_encode($json);
    }
}

