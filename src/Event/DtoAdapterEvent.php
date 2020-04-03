<?php

namespace Evrinoma\DtoBundle\Event;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class DtoAdapterEvent
 *
 * @package Evrinoma\DtoBundle\Event
 */
class DtoAdapterEvent extends Event
{
//region SECTION: Fields
    /**
     * @var DtoInterface
     */
    private $dtoFrom;

    /**
     * @var DtoInterface
     */
    private $dtoTo;

    private $class;
//endregion Fields

//region SECTION: Dto
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @return DtoInterface
     */
    public function getDtoFrom()
    {
        return $this->dtoFrom;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return DtoInterface
     */
    public function getDtoTo()
    {
        return $this->dtoTo;
    }

    /**
     * @param string $class
     *
     * @return DtoAdapterEvent
     */
    public function setClass(&$class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @param DtoInterface $dtoFrom
     *
     * @return DtoAdapterEvent
     */
    public function setDtoFrom(&$dtoFrom)
    {
        $this->dtoFrom = $dtoFrom;

        return $this;
    }

    /**
     * @param DtoInterface $dtoTo
     *
     * @return DtoAdapterEvent
     */
    public function setDtoTo(&$dtoTo)
    {
        $this->dtoTo = $dtoTo;

        return $this;
    }
//endregion Getters/Setters
}