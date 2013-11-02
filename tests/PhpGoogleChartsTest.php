<?php
class PhpGoogleChartsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $chart = new PhpGoogleCharts();
        $this->dataTable = $chart->createDataTable();
    }

    public function testExceptionOnDuplicatColumns()
    {
        $this->setExpectedException('InvalidArgumentException');
        $column = new PhpGoogleCharts\Column(
            PhpGoogleCharts\Column::TYPE_BOOLEAN,
            'test'
        );
        $this->dataTable->addColumn($column);
        $this->dataTable->addColumn($column);
    }

    public function testAddColumn()
    {
        $beforeCount = count($this->dataTable->getColumns());

        $column = new PhpGoogleCharts\Column(
            PhpGoogleCharts\Column::TYPE_BOOLEAN,
            'test'
        );
        $this->dataTable->addColumn($column);

        $afterCount = count($this->dataTable->getColumns());

        $this->assertEquals($beforeCount + 1, $afterCount);
    }

    public function testExceptionOnInvalidColumnType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $column = new PhpGoogleCharts\Column(
            'invalid column type',
            'test'
        );
    }

    public function testColumnToStringReturnsLabel()
    {
        $label = 'test';
        $column = new PhpGoogleCharts\Column(
            PhpGoogleCharts\Column::TYPE_BOOLEAN,
            $label
        );

        $this->assertEquals((string)$column, $column->getLabel());
    }

    public function testInsertRow()
    {
        $this->dataTable->insertRow(new PhpGoogleCharts\Row);

        $this->assertEquals(count($this->dataTable->getRows()), 1);
    }

    public function testSetCellWithSameColumnTypeOverridesPreviousCell()
    {
        $column = new PhpGoogleCharts\Column(
            PhpGoogleCharts\Column::TYPE_BOOLEAN,
            'test'
        );
        $cell1 = new PhpGoogleCharts\Cell($column, true);
        $cell2 = new PhpGoogleCharts\Cell($column, true);

        $row = new PhpGoogleCharts\Row;
        $row->setCell($cell1);
        $row->setCell($cell2);

        $this->assertNotSame(reset($row->getCells()), $cell1);
        $this->assertSame(reset($row->getCells()), $cell2);

    }
}

