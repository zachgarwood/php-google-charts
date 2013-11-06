<?php
class Chart
{
    protected
        $_data,
        $_options;

    public function __construct(Chart\DataTable $data, array $options = array())
    {
        $this->_data = $data;
        $this->_options = $options;
    }

    public function toHtml()
    {
        return '<div id="what" data-chart="' . $data->toJson() . '"></div>';
    }
}

