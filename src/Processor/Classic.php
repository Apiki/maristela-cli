<?php

namespace Maristela\Cli\Processor;

use Maristela\Cli\FileHandle;

class Classic implements IProcessor
{
    protected $fileHandle;

    public function __construct(FileHandle $fileHandle)
    {
        $this->fileHandle = $fileHandle;
    }

    public function compile(string $file) : string
    {
        $data = $this->fileHandle->getMockData($file);

        ob_start();

        extract($data);
        require $file;

        return ob_get_clean();
    }
}
