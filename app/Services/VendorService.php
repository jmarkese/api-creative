<?php


namespace App\Services;


use App\Services\Interfaces\IVendorService;

class VendorService implements IVendorService
{
    const DEFAULT = "default";
    const DREAM_JUNCTION = "dream-junction";
    const MARCO_FINE_ARTS = "marco-fine-arts";

    public function __construct()
    {}
}
