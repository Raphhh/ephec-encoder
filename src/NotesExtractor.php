<?php

namespace EphecEncoder;

class NotesExtractor
{
    private DirectoryHelper $directoryHelper;
    private NoteExtractorCsvStrategy $noteExtractorCsvStrategy;

    public function __construct(
        DirectoryHelper $directoryHelper, 
        NoteExtractorCsvStrategy $noteExtractorCsvStrategy
    ) {
        $this->directoryHelper = $directoryHelper;
        $this->noteExtractorCsvStrategy = $noteExtractorCsvStrategy;
    }

    public function extractFromFiles($directory): array
    {
        $result = [];
        foreach ($this->directoryHelper->getFilePathListFromDirectory($directory) as $filePath) {
            $result += $this->noteExtractorCsvStrategy->extractFromFile($filePath);
        }
        return $result;
    }
}