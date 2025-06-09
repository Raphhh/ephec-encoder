<?php

namespace EphecEncoder;

class NotesInjector
{
    private TemplateSheetHandler $templateSheetHandler;

    private DirectoryHelper $directoryHelper;

    public function __construct($directoryHelper, $templateSheetHandler)
    {
        $this->templateSheetHandler = $templateSheetHandler;
        $this->directoryHelper = $directoryHelper;
    }

    public function injectIntoTemplates($directory, array $notes)
    {
        foreach ($this->directoryHelper->getFilePathListFromDirectory($directory) as $filePath) {
            $this->injectIntoTemplate($filePath, $notes);
        }
    }
    
    private function injectIntoTemplate($filePath, array $notes)
    {
        echo "Read $filePath\n"; 

        $templateSheet = $this->templateSheetHandler->createFromFilePath($filePath);
        $this->associate($templateSheet, $notes);
        $this->templateSheetHandler->save($templateSheet, $filePath);
    }
    
    private function associate(TemplateSheet $templateSheet, array $notes)
    {
        $students = $templateSheet->extractStudentsRows();
        foreach ($students as $matricule => $student) {
            if (isset($notes[$matricule])) {
                $student->setNote($notes[$matricule]);
            } else {
                $student->setNote('A'); //"A" pour "absent"
            }
        }
    }
}