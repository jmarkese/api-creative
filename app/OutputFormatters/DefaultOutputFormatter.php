<?php


namespace App\OutputFormatters;


class DefaultOutputFormatter implements IOutputFormatter
{

    /**
     * MarcoFineArtsOrderOutputFormatter constructor.
     */
    public function __construct()
    {
    }

    public function output($data): string
    {
        return json_encode($data);
    }

    public function contentType(): string
    {
        return "application/json";
    }
}
