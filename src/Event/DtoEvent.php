<?php

namespace Evrinoma\DtoBundle\Event;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Contracts\EventDispatcher\Event;


class DtoEvent extends Event
{

    /**
     * @var DtoInterface
     */
    private $dto;


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

}