<?php

namespace EphecEncoder;

use \PhpOffice\PhpSpreadsheet\IOFactory;

class Converter
{
    private NotesExtractor $notesExtractor;

    private NotesInjector $notesInjector;
    
    public function __construct()
    {
        $fileInfoHelper = new FileInfoHelper();
        $directoryHelper = new DirectoryHelper();
        
        $noteExtractorCsvStrategy = new NoteExtractorCsvStrategy($fileInfoHelper);
        $this->notesExtractor = new NotesExtractor($directoryHelper, $noteExtractorCsvStrategy);

        $workSheetHandler = new WorkSheetHandler($fileInfoHelper);
        $templateSheetHandler = new TemplateSheetHandler($workSheetHandler);
        $this->notesInjector = new NotesInjector($directoryHelper, $templateSheetHandler);
    }
    
    function run($moodleDirectory, $templatesDirectory)
    {
        echo "\nExtract notes\n";
        $notes = $this->notesExtractor->extractFromFiles($moodleDirectory);

        echo "\nInject notes\n";
        $this->notesInjector->injectIntoTemplates($templatesDirectory, $notes);
    }
}