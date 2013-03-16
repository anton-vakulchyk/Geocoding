<?php
/**
 * Geocoding Interface
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding;

interface GeocodingInterface
{
    /**
     * @param string $value
     * @return ResultInterface result object
     */
    public function locate($value);
}