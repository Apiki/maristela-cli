<?php

namespace Maristela\Cli;

class FileHandle
{
    public function write(string $file, string $content, string $dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755);
        }

        $fileName = $this->getComponentName($file);

        file_put_contents("{$dir}/{$fileName}.html", $content);
    }

    public function getMockData(string $file) : array
    {
        $fileInfo = $this->getFileInfo($file);
        $mockFile = "{$fileInfo['dirname']}/mock.json";

        if (!file_exists($mockFile)) {
            throw new \InvalidArgumentException('The mock.json must be at same level of php file.');
        }

        $data = json_decode(file_get_contents($mockFile), true);

        if (empty($data)) {
            throw new \InvalidArgumentException('Invalid mock.json!');
        }

        return $data;
    }

    public function getComponentName(string $file) : string
    {
        $fileInfo = $this->getFileInfo($file);
        return basename($fileInfo['dirname']);
    }

    protected function getFileInfo(string $file) : array
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException("File: {$file} does not exists!");
        }

        $fileInfo = pathinfo($file);

        if ($fileInfo['extension'] !== 'php') {
            throw new \InvalidArgumentException('File need to be a php!');
        }

        return $fileInfo;
    }
}
