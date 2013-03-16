<?php
/**
 * Service Interface
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding\Service;

interface ServiceInterface
{
    /**
     * @param $value
     * @return array
     */
    public function getData($value);
}