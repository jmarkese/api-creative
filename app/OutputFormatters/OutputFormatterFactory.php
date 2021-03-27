<?php


namespace App\OutputFormatters;


use App\OutputFormatters\Order\OrderOutputFormatterFactory;

class OutputFormatterFactory implements IOutputFormatterFactory
{

    public function make(string $vendor, ?string $type): IOutputFormatter
    {
        switch ($type) {
            case "order":
                return OrderOutputFormatterFactory::make($vendor);
            default:
                return new DefaultOutputFormatter();
        }
    }
}
