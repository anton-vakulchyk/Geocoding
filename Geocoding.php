<?php
/**
 * Geocoding Class
 *
 * @author Anton Vakulchyk
 */

namespace Geocoding;

use Geocoding\Exception\GeocodingException;
use Geocoding\Result\Result;
use Geocoding\Service\ServiceInterface;

class Geocoding implements GeocodingInterface
{
    /**
     * @var ServiceInterface|null
     */
    private $service = null;

    /**
     * @var Result\Result|null
     */
    private $result = null;

    /**
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service = null)
    {
        $this->service = $service;
        $this->result = new Result();
    }

    /**
     * @param string $value
     * @return ResultInterface result object
     */
    public function locate($value)
    {
        $data = $this->getService()->getData(trim($value));
        $this->result->createFromArray($data);
        return $this->result;
    }

    /**
     * @return ServiceInterface|null
     * @throws Exception\GeocodingException
     */
    protected function getService()
    {
        if (null === $this->service) {
            throw new GeocodingException('No service found.');
        }
        return $this->service;
    }
}