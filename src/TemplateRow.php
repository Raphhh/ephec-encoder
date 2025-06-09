<?php

namespace EphecEncoder;

use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateRow
{
    private Worksheet $worksheet;

    private $rowIndex;

    public function __construct(Worksheet $worksheet, $rowIndex)
    {
        $this->worksheet = $worksheet;
        $this->rowIndex = $rowIndex;
    }

    public function getMatricule()
    {
        return $this->getCellByColumn('E')->getValue();
    }

    public function setNote($note)
    {
        $this->getCellByColumn('G')->setValue($note);
    }

    private function getCellByColumn($letter)
    {
        return $this->worksheet->getCell($letter . $this->rowIndex);
    }
}