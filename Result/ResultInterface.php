<?php
/**
 * Result Interface
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding\Result;

interface ResultInterface
{
    /**
     * @return string|int
     */
    public function getStreetNumber();

    /**
     * @return string
     */
    public function getStreetName();

    /**
     * @return string
     */
    public function getNeighborhood();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getCounty();

    /**
     * @return string
     */
    public function getCountyCode();

    /**
     * @return string
     */
    public function getRegion();

    /**
     * @return string
     */
    public function getRegionCode();

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @return string|int
     */
    public function getZipCode();

    /**
     * @return double
     */
    public function getLatitude();

    /**
     * @return double
     */
    public function getLongitude();

    /**
     * @return array
     */
    public function getBounds();

    /**
     * @return ResultInterface result object
     */
    public function createFromArray($data);
}