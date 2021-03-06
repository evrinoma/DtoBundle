<?php

namespace Evrinoma\DtoBundle\Dto;


use Evrinoma\DtoBundle\Core\DtoTrait;
use Evrinoma\DtoBundle\Factory\FactoryAdaptor;

/**
 * Class AbstractDto
 *
 * @package Evrinoma\DtoBundle\Dto
 */
abstract class AbstractDto implements DtoInterface
{
    //region SECTION: Protected
    /**
     * @return mixed
     */
    abstract protected function getClassEntity(): ?string;

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