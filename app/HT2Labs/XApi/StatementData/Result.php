<?php

namespace App\HT2Labs\XApi\StatementData;

class Result
{
    /** @var Score $score */
    public $score;
    /** @var bool $completion */
    public $completion;
    /** @var bool $success */
    public $success;

    /**
     * Result constructor.
     * @param bool $completion
     * @param bool $success
     * @param Score $score
     */
    public function __construct(bool $completion, bool $success, Score $score)
    {
        $this->completion = $completion;
        $this->success = $success;
        $this->score = $score;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'completion' => $this->completion,
            'success' => $this->success,
            'score' => $this->score->getData()
        ];
    }
}