<?php

namespace Maristela\Cli\Processor;

interface IProcessor
{
    public function compile(string $file) : string;
}
