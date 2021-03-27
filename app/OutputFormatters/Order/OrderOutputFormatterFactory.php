<?php


namespace App\OutputFormatters\Order;


use App\OutputFormatters\DefaultOutputFormatter;
use App\OutputFormatters\IOutputFormatter;
use App\Services\VendorService;

class OrderOutputFormatterFactory
{
    public static function make(string $vendor): IOutputFormatter
    {
        switch ($vendor) {
            case VendorService::DREAM_JUNCTION;
                return new DreamJunctionOrderOutputFormatter();
            case VendorService::MARCO_FINE_ARTS;
                return new MarcoFineArtsOrderOutputFormatter();
            default:
                return new DefaultOutputFormatter();
        }
    }
}
