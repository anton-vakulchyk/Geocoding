<?php
/**
 * Result Class
 *
 * @author Anton Vakulchyk
 */
namespace Geocoding\Result;

use Geocoding\Result\ResultInterface;

class Result implements ResultInterface
{
    /**
     * @var string|int
     */
    private $streetNumber = null;

    /**
     * @var string
     */
    private $streetName = null;

    /**
     * @var string
     */
    private $neighborhood = null;

    /**
     * @var string
     */
    private $city = null;

    /**
     * @var string
     */
    private $county = null;

    /**
     * @var string
     */
    private $countyCode = null;

    /**
     * @var string
     */
    private $region = null;

    /**
     * @var string
     */
    private $regionCode = null;

    /**
     * @var string
     */
    private $country = null;

    /**
     * @var string
     */
    private $countryCode = null;

    /**
     * @var string|int
     */
    private $zipCode = null;

    /**
     * @var double
     */
    private $latitude = null;

    /**
     * @var double
     */
    private $longitude = 0;

    /**
     * @var array
     */
    private $bounds = 0;

    /**
     * Returns street number
     *
     * @return int|null|string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Returns street name
     *
     * @return null|string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Returns neighborhood
     *
     * @return null|string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Returns city
     *
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns county
     *
     * @return null|string
     */
    public function getCounty()
    {
        return $this->country;
    }

    /**
     * Returns county code
     *
     * @return null|string
     */
    public function getCountyCode()
    {
        return $this->countyCode;
    }

    /**
     * Returns region
     *
     * @return null|string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Returns region code
     *
     * @return null|string
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }

    /**
     * Returns country
     *
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Returns country code
     *
     * @return null|string
     */
    public function getCountryCode()
    {
        return $this->countyCode;
    }

    /**
     * Returns zip code
     *
     * @return int|null|string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Returns latitude
     *
     * @return double|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns longitude
     *
     * @return double|int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Returns bounds
     *
     * @return array|int
     */
    public function getBounds()
    {
        return $this->bounds;
    }

    /**
     * Initializes ResultInterface object
     *
     * @param $data
     * @return ResultInterface|void
     */
    public function createFromArray($data)
    {
        if (isset($data['streetNumber'])) {
            $this->streetNumber = (string) $data['streetNumber'];
        }

        if (isset($data['streetName'])) {
            $this->streetName = (string) $data['streetName'];
        }

        if (isset($data['neighborhood'])) {
            $this->neighborhood = (string) $data['neighborhood'];
        }

        if (isset($data['city'])) {
            $this->city = (string) $data['city'];
        }

        if (isset($data['county'])) {
            $this->county = (string) $data['county'];
        }

        if (isset($data['countyCode'])) {
            $this->countyCode = (string) $data['countyCode'];
        }

        if (isset($data['region'])) {
            $this->region = $data['region'];
        }

        if (isset($data['regionCode'])) {
            $this->regionCode = $data['regionCode'];
        }

        if (isset($data['country'])) {
            $this->country = $data['country'];
        }

        if (isset($data['countryCode'])) {
            $this->countryCode = $data['countryCode'];
        }

        if (isset($data['zipCode'])) {
            $this->zipCode = (string) $data['zipCode'];
        }

        if (isset($data['latitude'])) {
            $this->latitude = (double) $data['latitude'];
        }

        if (isset($data['longitude'])) {
            $this->longitude = (double) $data['longitude'];
        }

        if (isset($data['bounds']) && is_array($data['bounds'])) {
            $this->bounds = array(
                'south' => (double) $data['bounds']['south'],
                'west'  => (double) $data['bounds']['west'],
                'north' => (double) $data['bounds']['north'],
                'east'  => (double) $data['bounds']['east']
            );
        }
    }
}