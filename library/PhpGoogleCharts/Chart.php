<?php
namespace PhpGoogleCharts;

use DataTable\Data;

class Chart
{
    const
        TYPE_BAR = 'Bar',
        TYPE_LINE = 'Line',
        TYPE_PIE = 'Pie';

    protected
        $_data,
        $_options,
        $_type;

    private static
        $_types = [
            self::TYPE_BAR,
            self::TYPE_LINE,
            self::TYPE_PIE,
        ];

    public function __construct($type, Data $data, array $options = array())
    {
        if (!in_array($type, self::$_types)) {
            throw new \InvalidArgumentException(
                "'$type' is not a valid chart type!"
            );
        }
        $this->_type = $type;
        $this->_data = $data;
        $this->_options = $options;
    }

    public function convertDataToJson()
    {
        $json = new \stdClass;

        $json->cols = array();
        foreach ($this->_data->getColumns() as $column) {
            $jsonCol = new \stdClass;
            $jsonCol->id = $column->getId();
            $jsonCol->label = $column->getLabel();
            $jsonCol->type = $column->getType();
            $json->cols []= $jsonCol;
        }

        $json->rows = array();
        foreach ($this->_data->getRows() as $row) {
            $jsonRow = new \stdClass;
            $jsonRow->c = array();
            $cells = $row->getCells();
            foreach ($this->_data->getColumns() as $column) {
                $jsonCell = null;
                if (array_key_exists((string)$column, $cells)) {
                    $jsonCell = new \stdClass;
                    $jsonCell->v = $cells[(string)$column]->value;
                    if (isset($cells[(string)$column]->label)) {
                        $jsonCell->f = $cells[(string)$column]->label;
                    }
                }
                $jsonRow->c []= $jsonCell;
            }
            $json->rows []= $jsonRow;
        }

        return json_encode($json);
    }
}

