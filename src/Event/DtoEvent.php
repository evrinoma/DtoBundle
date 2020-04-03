<?php

namespace Evrinoma\DtoBundle\Event;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Contracts\EventDispatcher\Event;


/**
 * Class DtoEvent
 *
 * @package Evrinoma\DtoBundle\Event
 */
class DtoEvent extends Event
{
//region SECTION: Fields
    /**
     * @var DtoInterface
     */
    private $dto;
//endregion Fields

//region SECTION: Dto
    /**
     * @return mixed
     */
    public function getDto()
    {
        return $this->dto;
    }

    /**
     * @param mixed $dto
     *
     * @return DtoEvent
     */
    public function setDto($dto)
    {
        $this->dto = $dto;

        return $this;
    }
//endregion SECTION: Dto
}