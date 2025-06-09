<?php

namespace EphecEncoder;

class FileInfoHelper
{
    public function getExtension($filePath)
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }

    public function isXls($filePath)
    {
        return $this->isType($filePath, 'xlsx');
    }

    public function isCsv($filePath)
    {
        return $this->isType($filePath, 'csv');
    }

    private function isType($filePath, $type)
    {
        return  $this->getExtension($filePath) === $type;
    }
}