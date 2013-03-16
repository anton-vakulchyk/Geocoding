<?php
/**
 * Google Maps Geocoding Service
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding\Service;

use Geocoding\Service\AbstractService;
use Geocoding\Service\ServiceInterface;

class GoogleMapsService extends AbstractService implements ServiceInterface
{
    /**
     * @var string
     */
    const URL = 'http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';

    /**
     * @var string
     */
    const URL_SSL = 'https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';

    /**
     * @var bool
     */
    private $useSsl = false;

    /**
     * @param bool $useSsl
     */
    public function __construct($useSsl = false)
    {
        $this->useSsl = $useSsl;
    }

    /**
     * Get data from query
     *
     * @param $address
     * @return array
     */
    public function getData($address)
    {
        $query = sprintf(
            $this->useSsl ? self::URL_SSL : self::URL,
            rawurlencode($address)
        );
        return $this->executeQuery($query);
    }

    /**
     * Execute query
     *
     * @param $query
     * @return array
     * @throws GeocodingException
     */
    protected function executeQuery($query)
    {
        $content = $this->getContent($query);
        // Empty response
        if (empty($content)) {
            throw new GeocodingException(sprintf('Content of query %s is empty', $query));
        }

        $json = json_decode($content);
        // Invalid response
        if (!isset($json)) {
            throw new GeocodingException(sprintf('Could not parse content of query %s', $query));
        }
        // No result or invalid status
        if (!isset($json->results) || !sizeof($json->results) || 'OK' !== $json->status) {
            throw new GeocodingException(sprintf('Could not execute query %s', $query));
        }

        $response = $json->results[0];
        $result = $this->getDefaults();

        // Handling data
        $result['fullAddress'] = $response->formatted_address;
        // Set address components
        $this->setAddressComponent($result, $response->address_components);
        // Set geometry data
        $this->setGeometry($result, $response->geometry);

        return array_merge($this->getDefaults(), $result);
    }

    /**
     * Set address components
     *
     * @param $result
     * @param $addressComponents
     */
    protected function setAddressComponent(&$result, $addressComponents)
    {
        foreach ($addressComponents as $component) {
            foreach ($component->types as $type) {
                switch ($type) {
                    case 'street_number':
                        $result['streetNumber'] = $component->long_name;
                        break;

                    case 'route':
                        $result['streetName'] = $component->long_name;
                        break;

                    case 'neighborhood':
                        $result['neighborhood'] = $component->long_name;
                        break;

                    case 'locality':
                        $result['city'] = $component->long_name;
                        break;

                    case 'administrative_area_level_2':
                        $result['county'] = $component->long_name;
                        $result['countyCode'] = $component->short_name;
                        break;

                    case 'administrative_area_level_1':
                        $result['region'] = $component->long_name;
                        $result['regionCode'] = $component->short_name;
                        break;

                    case 'country':
                        $result['country'] = $component->long_name;
                        $result['countryCode'] = $component->short_name;
                        break;

                    case 'postal_code':
                        $result['zipCode'] = $component->long_name;
                        break;

                    default:
                }
            }
        }
    }

    /**
     * Set geometry data
     *
     * @param $result
     * @param $geometry
     */
    protected function setGeometry(&$result, $geometry)
    {
        $result['latitude']  = $geometry->location->lat;
        $result['longitude'] = $geometry->location->lng;

        if (isset($geometry->bounds)) {
            $result['bounds'] = array(
                'south' => $geometry->bounds->southwest->lat,
                'west'  => $geometry->bounds->southwest->lng,
                'north' => $geometry->bounds->northeast->lat,
                'east'  => $geometry->bounds->northeast->lng
            );
        }
    }
}