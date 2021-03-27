<?php


namespace App\OutputFormatters;


interface IOutputFormatterFactory
{
    public function make(string $vendor, ?string $type): IOutputFormatter;
}
