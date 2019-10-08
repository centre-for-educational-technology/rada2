<?php

namespace App\HT2Labs\XApi\StatementData;

class Context
{
    /** @var array $contextActivities */
    public $contextActivities;

    /**
     * Context constructor.
     * @param string $id
     * @param string $url
     */
    public function __construct(string $id, string $url = null)
    {
        $this->contextActivities = [
            'parent' => [
                'id' => $id
            ]
        ];
        if ($url !== null) {
            $this->contextActivities['parent']['url'] = $url;
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'contextActivities' => $this->contextActivities
        ];
    }
}