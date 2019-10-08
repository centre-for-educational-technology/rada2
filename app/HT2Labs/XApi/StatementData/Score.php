<?php

namespace App\HT2Labs\XApi\StatementData;

class Score
{
    /** @var integer $min */
    public $min;
    /** @var integer $max */
    public $max;
    /** @var integer $raw */
    public $raw;
    /** @var integer $scaled */
    public $scaled;

    /**
     * Score constructor.
     * @param int $min
     * @param int $max
     * @param int $raw
     * @param int $scaled
     */
    public function __construct(int $min, int $max, int $raw, int $scaled)
    {
        $this->min = $min;
        $this->max = $max;
        $this->raw = $raw;
        $this->scaled = $scaled;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'min' => $this->min,
            'max'=> $this->max,
            'raw' => $this->raw,
            'scaled' => $this->scaled
        ];
    }
}