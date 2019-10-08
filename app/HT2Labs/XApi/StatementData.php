<?php

namespace App\HT2Labs\XApi;

use App\HT2Labs\XApi\StatementData\Actor;
use App\HT2Labs\XApi\StatementData\Context;
use App\HT2Labs\XApi\StatementData\ObjectData;
use App\HT2Labs\XApi\StatementData\Result;
use App\HT2Labs\XApi\StatementData\Verb;

class StatementData
{
    /** @var Actor $actor */
    public $actor;
    /** @var Verb $verb */
    public $verb;
    /** @var ObjectData $object */
    public $object;
    /** @var string $timestamp */
    public $timestamp;
    /** @var Context $context */
    public $context;
    /** @var Result $result */
    public $result;

    /**
     * StatementData constructor.
     * @param Actor $actor
     * @param Verb $verb
     * @param ObjectData $object
     * @param string|null $timestamp
     * @param Context|null $context
     * @param Result|null $result
     */
    public function __construct(
        Actor $actor,
        Verb $verb,
        ObjectData $object,
        string $timestamp = null,
        Context $context = null,
        Result $result = null
    ) {
        $this->actor = $actor;
        $this->verb = $verb;
        $this->object = $object;
        $this->timestamp = $timestamp;
        $this->context = $context;
        $this->result = $result;

        if ($timestamp === null) {
            $this->timestamp = date(DATE_RFC3339);
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [
            'actor' => $this->actor->getData(),
            'verb' => $this->verb->getData(),
            'object' => $this->object->getData(),
            'timestamp' => $this->timestamp
        ];

        if ($this->context !== null) {
            $data['context'] = $this->context->getData();
        }
        if ($this->result !== null) {
            $data['result'] = $this->result->getData();
        }

        return $data;
    }
}