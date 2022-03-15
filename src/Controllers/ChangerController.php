<?php

namespace App\Controllers;

use App\Services\CalculateService;
use Exception;

/**
 * ChangerController
 */
class ChangerController
{
    /**
     * @var mixed
     */
    private $rates;

    /**
     * @var CalculateService
     */
    private CalculateService $calculateService;

    /**
     * @var string
     */
    private string $apiUrl = 'http://api.exchangeratesapi.io/latest?access_key=08be14db96023dbc55b725b08122a2b7';

    /**
     * ChangerController constructor
     */
    function __construct()
    {
        $this->calculateService = new CalculateService();
        $this->rates = json_decode(file_get_contents($this->apiUrl), true);
    }

    /**
     * @param $jsonFile
     * @return void
     * @throws Exception
     */
    public function calculateCommission($jsonFile)
    {
        $rows = explode("\n", $jsonFile);

        foreach ($rows as $row) {
            if (empty($row))
                throw new Exception("Empty Row");
            print $this->calculateService->calculate($row, $this->rates) . "\n";
        }
    }
}
