<?php

namespace Evrinoma\DtoBundle\Dto;

abstract class AbstractDto implements DtoInterface
{
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