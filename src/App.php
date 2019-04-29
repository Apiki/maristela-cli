<?php

namespace Maristela\Cli;

use Composer\Script\Event;
use Maristela\Cli\FileHandle;
use Maristela\Cli\Processor\Classic as Processor;

class App
{
    public static function buildComponents(Event $event)
    {
        $config = self::getConfigurations($event);

        $fileHandle = new FileHandle();
        $processor  = new Processor($fileHandle);

        $files = glob("{$config['componentsDir']}/**/index.php");

        foreach ($files as $file) {
            $fileHandle->write(
                $file,
                $processor->compile($file),
                "{$config['componentsDir']}/_static"
            );
        }
    }

    private static function getConfigurations(Event $event)
    {
        $baseDir = $event->getComposer()->getConfig()->get('vendor-dir') . '/../';

        $defaults = [
            'componentsDir' => $baseDir . 'components/',
        ];

        $file = $baseDir . '.maristela-cli.json';

        if (!file_exists($file)) {
            return $defaults;
        }

        $config = json_decode(file_get_contents($file), true);

        if (empty($config['componentsDir'])) {
            throw new \Exception('The "componentsDir" is not defined on config file.');
        }

        $config['componentsDir'] = "{$baseDir}{$config['componentsDir']}";

        return array_merge($defaults, $config);
    }
}
