<?php

namespace EphecEncoder;

use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateSheet
{
    private Worksheet $worksheet;
    
    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet = $worksheet;
    }

    public function getWorksheet(): Worksheet
    {
        return $this->worksheet;
    }
    
    public function extractStudentsRows(): array
    {
        $result = [];
        for ($i = 1; $i <= $this->worksheet->getHighestRow(); $i++) {
            $row = new TemplateRow($this->worksheet, $i);
            $matricule = $row->getMatricule();
            if ($matricule && $matricule !== 'Matricule') { // ne pas se fier au format du matricule comme filtre
                $result[$matricule] = $row;
            }
        }
        return $result;
    }
}