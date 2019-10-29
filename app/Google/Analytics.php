<?php
/**
 * Created by PhpStorm.
 * Date: 25.10.19
 * Time: 18:25
 */

namespace App\Google;

use Exception;
use Google_Client;
use Google_Exception;
use Google_Service_Analytics;
use Google_Service_Analytics_Account;
use Google_Service_Analytics_Accounts;
use Google_Service_Analytics_GaData;
use Google_Service_Analytics_Profile;
use Google_Service_Analytics_Profiles;
use Google_Service_Analytics_Resource_DataGa;
use Google_Service_Analytics_Resource_ManagementAccounts;
use Google_Service_Analytics_Resource_ManagementProfiles;
use Google_Service_Analytics_Resource_ManagementWebproperties;
use Google_Service_Analytics_Webproperties;
use Google_Service_Analytics_Webproperty;
use RuntimeException;

class Analytics
{

    public const TYPE_MAX = 'max';
    public const TYPE_LAST_MONTH = 'last-month';
    public const TYPE_LAST_WEEK = 'last-week';

    public const START_DATE_MAX = '2005-01-01';
    public const START_DATE_LAST_MONTH = '30daysAgo';
    public const START_DATE_LAST_WEEK = '7daysAgo';

    public const DIMENSION_MAX = 'ga:YearMonth';
    public const DIMENSION_LAST_MONTH = 'ga:week';
    public const DIMENSION_LAST_WEEK = 'ga:day';

    /** @var Google_Service_Analytics $analytics */
    protected $analytics;
    /** @var Google_Service_Analytics_Profile $profile */
    protected $profile;

    /**
     * Analytics constructor.
     * @throws Google_Exception
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function getRows(string $type): array
    {
        return $this->getResults($type)->getRows() ?? [];
    }

    /**
     * @throws Google_Exception
     */
    protected function initialize(): void
    {
        $KEY_FILE_LOCATION = __DIR__ . '/../../' . env('GOOGLE_SERVICE_ACCOUNT_KEY_JSON_NAME');

        $client = new Google_Client();
        $client->setApplicationName('Hello Analytics Reporting');
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $this->analytics = new Google_Service_Analytics($client);
        $firstAccount = $this->getFirstAccount();
        $firstProperty = $this->getFirstProperty($firstAccount);
        $this->profile = $this->getFirstProfile($firstAccount, $firstProperty);
    }

    protected function getFirstAccount(): Google_Service_Analytics_Account
    {
        /** @var Google_Service_Analytics_Resource_ManagementAccounts $managementAccounts */
        $managementAccounts = $this->analytics->management_accounts;

        // Get the list of accounts for the authorized user.
        /** @var Google_Service_Analytics_Accounts $accounts */
        $accounts = $managementAccounts->listManagementAccounts();

        /** @var array $items */
        $items = $accounts->getItems();

        if (count($items) > 0) {
            return $items[0];
        }

        throw new RuntimeException('No accounts found for this user.');
    }

    /**
     * @param Google_Service_Analytics_Account $firstAccount
     *
     * @return Google_Service_Analytics_Webproperty
     * @throws RuntimeException
     */
    protected function getFirstProperty(
        Google_Service_Analytics_Account $firstAccount
    ): Google_Service_Analytics_Webproperty {
        /** @var Google_Service_Analytics_Resource_ManagementWebproperties $managementWebProperties */
        $managementWebProperties = $this->analytics->management_webproperties;

        // Get the list of properties for the authorized user.
        /** @var Google_Service_Analytics_Webproperties $properties */
        $properties = $managementWebProperties->listManagementWebproperties($firstAccount->getId());

        /** @var array $items */
        $items = $properties->getItems();

        if (count($items) > 0) {
            return $items[0];
        }

        throw new RuntimeException('No properties found for this user.');
    }

    /**
     * @param Google_Service_Analytics_Account     $firstAccount
     * @param Google_Service_Analytics_Webproperty $firstProperty
     *
     * @return Google_Service_Analytics_Profile
     * @throws RuntimeException
     */
    protected function getFirstProfile(
        Google_Service_Analytics_Account $firstAccount,
        Google_Service_Analytics_Webproperty $firstProperty
    ): Google_Service_Analytics_Profile {

        /** @var Google_Service_Analytics_Resource_ManagementProfiles $managementProfiles */
        $managementProfiles = $this->analytics->management_profiles;

        /** @var Google_Service_Analytics_Profiles $profiles */
        $profiles = $managementProfiles->listManagementProfiles($firstAccount->getId(), $firstProperty->getId());

        /** @var array $items */
        $items = $profiles->getItems();

        if (count($items) > 0) {
            return $items[0];
        }

        throw new RuntimeException('No views (profiles) found for this user.');
    }

    /**
     * @param string $type
     *
     * @return Google_Service_Analytics_GaData
     */
    protected function getResults(string $type): Google_Service_Analytics_GaData
    {
        switch($type) {
            case static::TYPE_MAX:
                $startDate = static::START_DATE_MAX;
                $dimensions = static::DIMENSION_MAX;
                break;
            case static::TYPE_LAST_MONTH:
                $startDate = static::START_DATE_LAST_MONTH;
                $dimensions = static::DIMENSION_LAST_MONTH;
                break;
            default:
                $startDate = static::START_DATE_LAST_WEEK;
                $dimensions = static::DIMENSION_LAST_WEEK;
        }

        // Calls the Core Reporting API and queries for the number of sessions
        /** @var Google_Service_Analytics_Resource_DataGa $dataGa */
        $dataGa = $this->analytics->data_ga;
        return $dataGa->get(
            'ga:' . $this->profile->getId(),
            $startDate,
            'yesterday',
            'ga:sessions',
            [
                'dimensions' => $dimensions,
                'filters' => 'ga:sessions!=0'
            ]
        );
    }
}