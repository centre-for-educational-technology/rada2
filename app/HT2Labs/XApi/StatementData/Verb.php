<?php

namespace App\HT2Labs\XApi\StatementData;

use RuntimeException;

class Verb
{
    public const TYPE_STARTED = 'started';
    public const TYPE_ANSWERED = 'answered';
    public const TYPE_COMPLETED = 'completed';

    public const ID_STARTED = 'http://activitystrea.ms/schema/1.0/start';
    public const ID_ANSWERED = 'http://adlnet.gov/expapi/verbs/answered';
    public const ID_COMPLETED = 'http://adlnet.gov/expapi/verbs/completed';

    /** @var string $id */
    public $id;
    /** @var array $display */
    public $display;

    /**
     * Verb constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        switch ($type) {
            case static::TYPE_STARTED:
                $this->id = static::ID_STARTED;
                break;
            case static::TYPE_ANSWERED:
                $this->id = static::ID_ANSWERED;
                break;
            case static::TYPE_COMPLETED:
                $this->id = static::ID_COMPLETED;
                break;
            default:
                throw new RuntimeException('Invalid verb type');
        }
        $this->display = [
            'en-US' => $type
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'id' => $this->id,
            'display' => $this->display
        ];
    }
}