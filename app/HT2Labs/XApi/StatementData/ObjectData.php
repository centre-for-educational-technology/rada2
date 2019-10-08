<?php

namespace App\HT2Labs\XApi\StatementData;

class ObjectData
{

    public const TYPE_UUID = 'StatementRef';
    public const TYPE_ACTIVITY = 'Activity';

    /** @var string $id */
    public $id;
    /** @var string $objectType */
    public $objectType;
    /** @var array $definition */
    public $definition;

    /**
     * ObjectData constructor.
     * @param string $type
     * @param string $id
     * @param string $name
     */
    public function __construct(string $type, string $id, string $name)
    {
        $this->objectType = $type;
        $this->id = $id;
        $this->definition = [
            'name' => [
                'en-US' => $name
            ]
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'objectType' => $this->objectType,
            'id' => $this->id,
            'definition' => $this->definition
        ];
    }
}