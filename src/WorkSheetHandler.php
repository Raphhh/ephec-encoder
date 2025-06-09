<?php

namespace EphecEncoder;

use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WorkSheetHandler
{ 
    private FileInfoHelper $fileInfoHelper;

    public function __construct(FileInfoHelper $fileInfoHelper)
    {
        $this->fileInfoHelper = $fileInfoHelper;
    }

    public function createFromFilePath($filePath): Worksheet
    {
        $inputFileType = 'Xlsx';

        if (!$this->fileInfoHelper->isXls($filePath)) {
            throw new \InvalidArgumentException(printf(
                    'manage only xlsx extension for template file, %s given', 
                    $this->fileInfoHelper->getExtension($filePath)
                ));
        }

        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($filePath);
        return $spreadsheet->getActiveSheet();
    }

    public function save(Worksheet $worksheet, $filePath)
    {
        $spreadSheet = $worksheet->getParent();
        if ($spreadSheet) {
            $writer = new Xlsx($spreadSheet);
            $writer->save($filePath);
        }
    }
}