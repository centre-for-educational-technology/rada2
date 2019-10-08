<?php

namespace App\HT2Labs\XApi\StatementData;

class Actor
{
    /** @var string $name */
    public $name;
    /** @var string $mbox */
    public $mbox;
    /** @var string $objectType */
    public $objectType;

    /**
     * Actor constructor.
     * @param string $name
     * @param string $email
     * @param string $role
     */
    public function __construct(string $name, string $email, string $role)
    {
        $this->name = $name;
        $this->mbox = $email;
        $this->objectType = $role;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'name' => $this->name,
            'mbox' => $this->mbox,
            'objectType' => $this->objectType
        ];
    }
}