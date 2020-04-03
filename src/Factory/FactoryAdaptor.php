<?php

namespace Evrinoma\DtoBundle\Factory;


use Evrinoma\DtoBundle\Event\DtoAdapterEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class FactoryAdaptor
 *
 * @package Evrinoma\DtoBundle\Factory
 */
class FactoryAdaptor
{
//region SECTION: Fields
    private $from;
    private $to;
    private $eventDispatcher;
//endregion Fields

//region SECTION: Constructor
    /**
     * FactoryDto constructor.
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
//endregion Constructor

//region SECTION: Public
    public function adapter()
    {
        if ($this->from->getClass() !== $this->to) {
            $event = new DtoAdapterEvent();
            $event->setClass($this->to)->setDtoFrom($this->from);
            $this->eventDispatcher->dispatch($event);

            $dtoTo = $event->getDtoTo();
        } else {
            $dtoTo = $this->from;
        }

        return $dtoTo;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param string $from
     *
     * @return FactoryAdaptor
     */
    public function setFrom(&$from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param string $to
     *
     * @return FactoryAdaptor
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }
//endregion Getters/Setters

}