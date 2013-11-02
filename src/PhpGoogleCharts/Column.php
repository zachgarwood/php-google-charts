<?php
namespace PhpGoogleCharts;

class Column
{
    const
        TYPE_BOOLEAN = 'boolean',
        TYPE_DATE = 'date',
        TYPE_DATETIME = 'datetime',
        TYPE_NUMBER = 'number',
        TYPE_STRING = 'string';

    private
        $_label,
        $_type;

    private static
        $_types = [
            self::TYPE_BOOLEAN,
            self::TYPE_DATE,
            self::TYPE_DATETIME,
            self::TYPE_NUMBER,
            self::TYPE_STRING,
        ];

    public function __construct($type, $label)
    {
        if (!in_array($type, self::$_types)) {
            throw new \InvalidArgumentException(
                "'$type' is not a valid data type!"
            );
        }
        $this->_type = $type;
        $this->_label = $label;
    }

    public function getId()
    {
        return $this->_label . $this->_type;
    }

    public function getLabel()
    {
        return $this->_label;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function __toString()
    {
        return $this->_label;
    }
}

