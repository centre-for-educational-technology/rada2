<?php

namespace App\Services;

class OpenBadgesService
{
    /**
     * Returns current context version URI
     * @return string Context URI
     */
    public static function getContextUri()
    {
        return 'https://w3id.org/openbadges/v1';
    }

    /**
     * Returns Recipient Identity email hash
     * @param  string $email Email address
     * @return string        SHA256 hashed email with special prefix
     */
    public static function hashRecipientIdentity(string $email)
    {
        return 'sha256$' . hash('sha256', $email);
    }

    /**
     * Returns URI hash
     * @param  string $uri Assertion URI
     * @return string      SHA256 hash or provided URI
     */
    public static function assertionUid(string $uri)
    {
        return hash('sha256', $uri);
    }
}
