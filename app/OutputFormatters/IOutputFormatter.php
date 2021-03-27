<?php


namespace App\OutputFormatters;


interface IOutputFormatter
{

    public function output($data): string;
    public function contentType(): string;

}
