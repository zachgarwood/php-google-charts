<?php
class PhpGoogleChartsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $data = new DataTable\Data;
        $col1 = new DataTable\Column(DataTable\Column::TYPE_BOOLEAN, 'boolean');
        $col2 = new DataTable\Column(DataTable\Column::TYPE_STRING, 'string');

        $cell1 = new DataTable\Cell($col1, true);
        $cell2 = new DataTable\Cell($col2, 'string');
        $row1 = new DataTable\Row;
        $row1->setCell($cell1)->setCell($cell2);

        $data->addColumn($col1)->addColumn($col2);
        $data->insertRow($row1);

        $this->chart = new PhpGoogleCharts\Chart(
            PhpGoogleCharts\Chart::TYPE_PIE,
            $data
        );
    }

    public function testExceptionOnInvalidChartType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->chart = new PhpGoogleCharts\Chart(
            'INVALID CHART TYPE!',
            new DataTable\Data
        );
    }

    public function testJsonIsValid()
    {
        json_decode($this->chart->convertDataToJson());
        $this->assertSame(JSON_ERROR_NONE, json_last_error());
    }

    public function testJsonIsProperlyFormatted()
    {
        $this->assertJsonStringEqualsJsonFile(
            'tests/fixtures/data.json',
            $this->chart->convertDataToJson()
        );
    }
}

