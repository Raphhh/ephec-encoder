<?php

namespace EphecEncoder;

class DirectoryHelper
{
    public function getFilePathListFromDirectory($directory): array
    {
        $result = [];
        foreach (new \DirectoryIterator($directory) as $fileInfo) {
            if($fileInfo->isDot()) {
                continue;
            }
            $result[] =  $directory . DIRECTORY_SEPARATOR . $fileInfo->getFilename();
        }
        return $result;
    }
}