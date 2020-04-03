<?php

namespace Evrinoma\DtoBundle\Factory;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoApartInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Event\DtoEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class FactoryDto
 *
 * @package Evrinoma\DtoBundle\Factory
 */
class FactoryDto
{
//region SECTION: Fields
    private $request;
    private $eventDispatcher;
    private $pull = [];
    private $factoryAdaptor;
//endregion Fields

//region SECTION: Constructor

    /**
     * FactoryDto constructor.
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, FactoryAdaptor $factoryAdaptor)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->factoryAdaptor  = $factoryAdaptor;
    }
//endregion Constructor

//region SECTION: Private
    /**
     * @param $dto DtoInterface
     */
    private function push($dto)
    {
        $this->pull[$dto->getClass()] = $dto;

    }
//endregion Private

//region SECTION: Dto
    /**
     * @param $class
     *
     * @return DtoInterface
     */
    public function createDto($class)
    {
        $dto = new $class;
        if ($dto instanceof DtoInterface) {
            if ($this->request) {
                if (!$this->hasDto($dto)) {
                    /** @var DtoInterface $class */
                    $request = clone $this->request;
                    /** @var AbstractDto $dto */
                    $dto     = $class::initDto($request);
                    $dto
                        ->toDto($request)
                        ->setFactoryAdapter($this->factoryAdaptor);
                    $this->push($dto);
                    $event = new DtoEvent();
                    $event->setDto($dto);
                    $this->eventDispatcher->dispatch($event);
                } else {
                    $dto = $this->getDtoByClass($class);
                }
            }
        } else {
            $dto = null;
        }

        return $dto;
    }

    /**
     * @param $class
     *
     * @return DtoInterface
     */
    public function cloneDto($class)
    {
        $dto = new $class;
        if ($dto instanceof DtoInterface) {
            if ($this->hasDto($dto)) {
                $dto = clone $this->getDtoByClass($class);
            }
            /** @var AbstractDto $dto */
            $dto->setFactoryAdapter($this->factoryAdaptor);

        } elseif (!($dto instanceof DtoApartInterface)) {
            $dto = null;
        }

        return $dto;
    }


    /**
     * @param DtoInterface $dto
     *
     * @return bool
     */
    public function hasDto($dto)
    {
        return array_key_exists($dto->getClass(), $this->pull);
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    public function getDtoByClass($class)
    {
        return $this->pull[$class];
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }
//endregion Getters/Setters
}