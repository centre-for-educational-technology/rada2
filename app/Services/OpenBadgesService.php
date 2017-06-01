<?php

namespace App\Services;

use App\Badge;
use App\User;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

class OpenBadgesService
{
    /**
     * Public key storage attribute
     *
     * @var string
     */
    private $publicKey;
    /**
     * Private key storage attribute
     *
     * @var string
     */
    private $privateKey;

    /**
     * Returns current context version URI
     * @return string Context URI
     */
    public static function getContextUri()
    {
        return 'https://w3id.org/openbadges/v1';
    }

    /**
     * Reads and returns the key from specified location.
     * @param  string $path Key storage path
     * @return string       Key data
     */
    private static function getKey(string $path)
    {
        return Storage::disk('local')->get($path);
    }

    /**
     * Returns public key
     * @return string Key data
     */
    public function getPublicKey()
    {
        if ( !$this->publicKey )
        {
            $this->publicKey = self::getKey('keys/public-key.pem');
        }

        return $this->publicKey;
    }

    /**
     * Returns private key
     * @return string Key data
     */
    private function getPrivateKey()
    {
        if ( !$this->privateKey )
        {
            $this->privateKey = self::getKey('keys/private-key.pem');
        }

        return $this->privateKey;
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
     * Returns hash consisting of Badge ID and User ID, with dollar sign in between
     * @param  string $uri Assertion URI
     * @return string      SHA256 hash or provided URI
     */
    public static function assertionUid(Badge $badge, User $user)
    {
        return hash('sha256', $badge->id . '$' . $user->id);
    }

    /**
     * Returns Issuer data
     * @return array Array with Issuer data
     */
    public static function issuerData()
    {
        return [
            '@context' => self::getContextUri(),
            'id' => route('api.badge.issuer'),
            'type' => 'Issuer',
            'name' => 'Smart Zoos',
            'url' => 'https://smartzoos.eu/',
            'description' => 'Smart Zoos Project',
            'image' => asset('img/logos/logo-square.png'),
            'email' => 'info@smartzoos.eu',
        ];
    }

    /**
     * Returns Badge data
     * @param  Badge  $badge Badge object
     * @return array         Array with Badge data
     */
    public static function badgeData(Badge $badge)
    {
        return [
            '@context' => self::getContextUri(),
            'id' => route('api.badge.show', ['badge' => $badge->id]),
            'type' => 'BadgeClass',
            'name' => $badge->name,
            'description' => $badge->description,
            'image' => $badge->getImageUrl(),
            'criteria' => $badge->getCriteriaUrl(),
            'issuer' => route('api.badge.issuer'),
            'tags' => ['smartzoos', 'toolset', 'badge',],
        ];
    }

    /**
     * Returns data for signed Assertion
     * @param  Badge  $badge Badge object with pivot data
     * @param  User   $user  User object
     * @return array         Array with signed Assertion data
     */
    public static function signedAssertionData(Badge $badge, User $user)
    {
        if ( !isset($badge->pivot->created_at) )
        {
            throw new \Exception('Badge missing created_at pivot data');
        }

        return [
            '@context' => self::getContextUri(),
            'type' => 'Assertion',
            'uid' => self::assertionUid($badge, $user),
            'recipient' => [
                'identity' => self::hashRecipientIdentity($user->email),
                'type' => 'email',
                'hashed' => true,
            ],
            'badge' => route('api.badge.show', ['badge' => $badge->id]),
            'verify' => [
                'type' => 'signed',
                'url' => route('api.badge.key'),
            ],
            'issuedOn' => $badge->pivot->created_at->toIso8601String(),
        ];
    }

    /**
     * Returns signed assertion JSON Web Signature (JWS)
     * @param  Badge  $badge Badge object
     * @param  User   $user  User object
     * @return string        JWS signature
     */
    public function assertionSignature(Badge $badge, User $user)
    {
        return JWT::encode(self::signedAssertionData($badge, $user), $this->getPrivateKey(), 'RS256');
    }
}
