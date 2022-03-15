<?php

namespace App\Services;

use Exception;

/**
 *
 */
class CalculateService
{
    /**
     *
     */
    const COUNTRY_CODES = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'];

    /**
     * @throws Exception
     */
    public function calculate($row, $rates)
    {
        $row = json_decode($row);

        $binResults = file_get_contents('https://lookup.binlist.net/' . $row->bin);

        if (!$binResults)
            die('error!');
        $r = json_decode($binResults);
        $isEu = $this->isEu($r->country->alpha2);

        $rate = $rates["rates"][$row->currency];

        if ($row->currency == 'EUR' or $rate == 0) {
            $amountFixed = $row->amount;
        } else {
            $amountFixed = $row->amount / $rate;
        }

        echo round_up($amountFixed * ($isEu ? 0.01 : 0.02), 2);
    }

    /**
     * @param $c
     * @return bool
     */
    private function isEu($c): bool
    {
        return in_array($c, self::COUNTRY_CODES);
    }
}
