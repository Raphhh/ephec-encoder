<?php

namespace EphecEncoder;

class NoteExtractorCsvStrategy
{
    private FileInfoHelper $fileInfoHelper;

    public function __construct(FileInfoHelper $fileInfoHelper)
    {
        $this->fileInfoHelper = $fileInfoHelper;
    }

    public function extractFromFile($filePath): array
    {
        echo "Read $filePath\n"; 

        if (!$this->fileInfoHelper->isCsv($filePath)) {
            throw new \InvalidArgumentException(printf(
                    'manage only csv extension for moodle file, %s given', 
                    $this->fileInfoHelper->getExtension($filePath)
                ));
        }
       
        $result = [];
        
        $total = 0;
        foreach ($this->loopCsv($filePath) as $data) {
            if (!$data[2]) {
                continue;
            }

            if ($total == 0) {
                $total = $this->extractNoteTotal($data[8]);
                continue;
            }
            
            $matricule =  $this->extractMatriculeFromEmailAdress($data[2]);
            $result[$matricule] = $this->formatNote($data[8], $total);
        }
        
        echo "Found " . count($result) . " results\n"; 
        return $result;
    }

    private function loopCsv($filePath): \Iterator
    {
        $file = fopen($filePath, 'r');
        if ($file) {
            while (($data = fgetcsv($file)) !== false) {
                yield $data;
            }
            fclose($file);
        }
    }

    private function extractNoteTotal($string)
    {
        return $this->stringToFloat(substr($string, 5, 5));
    }

    private function extractMatriculeFromEmailAdress($emailAdress)
    {
        return strtoupper(explode('@', $emailAdress)[0]);
    }

    private function formatNote($note, $total)
    {
        return $this->stringToFloat($note) / $total * 20;
    }
    
    private function stringToFloat($string)
    {
        return (float)str_replace(',', '.', $string);
    }
}