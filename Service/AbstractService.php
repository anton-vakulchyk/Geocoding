<?php
/**
 * Abstract Service Class
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding\Service;

abstract class AbstractService
{
    /**
     * Get default results
     * @return array
     */
    protected function getDefaults()
    {
        return array(
            'streetNumber'  => null,
            'streetName'    => null,
            'neighborhood'  => null,
            'city'          => null,
            'county'        => null,
            'countyCode'    => null,
            'region'        => null,
            'regionCode'    => null,
            'country'       => null,
            'countryCode'   => null,
            'zipCode'       => null,
            'latitude'      => null,
            'longitude'     => null,
            'bounds'        => null,
        );
    }

    /**
     * @param $url
     * @return string|null
     */
    public function getContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $content = curl_exec($ch);
        curl_close($ch);

        if (false === $content) {
            $content = null;
        }

        return $content;
    }
}