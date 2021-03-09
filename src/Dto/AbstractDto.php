<?php

namespace Evrinoma\DtoBundle\Dto;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractDto implements DtoInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @return Request
     */
    public function getCloneRequest():Request
    {
        if (!$this->request) {
            $this->request = new Request();
        }

        return clone $this->request;
    }
//region SECTION: Dto
    /**
     * @return DtoInterface
     */
    public static function initDto(): DtoInterface
    {
        return new static();
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function getClass(): string
    {
        return static::class;
    }
//endregion Getters/Setters
}