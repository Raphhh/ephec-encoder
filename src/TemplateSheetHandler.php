<?php

namespace EphecEncoder;

class TemplateSheetHandler
{
    private WorkSheetHandler $workSheetHandler;
    
    public function __construct(WorkSheetHandler $workSheetHandler)
    {
        $this->workSheetHandler = $workSheetHandler;
    }
    
    public function createFromFilePath($filePath): TemplateSheet
    {
        return new TemplateSheet(
            $this->workSheetHandler->createFromFilePath($filePath)
        );
    }

    public function save(TemplateSheet $templateSheet, $filePath)
    {
        $this->workSheetHandler->save(
            $templateSheet->getWorksheet(), 
            $filePath
        );
    }
}