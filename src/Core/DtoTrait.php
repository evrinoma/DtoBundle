<?php

namespace Evrinoma\DtoBundle\Core;

/**
 * Trait DtoTrait
 *
 * @package Evrinoma\DtoBundle\Core
 */
trait DtoTrait
{
    /**
     * @return string
     */
    public function getClass()
    {
        return static::class;
    }
}