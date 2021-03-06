<?php

namespace Evrinoma\DtoBundle\Dto;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface DtoInterface
 *
 * @package Evrinoma\DtoBundle\Dto
 */
interface DtoInterface
{
//region SECTION: Fields
    public const DTO_CLASS = 'class';
//endregion Fields
//region SECTION: Dto

    /**
     * @return DtoInterface
     */
    public static function initDto(): DtoInterface;

    /**
     * @param Request $request
     *
     * @return AbstractDto
     */
    public function toDto(Request $request): DtoInterface;
//endregion SECTION: Dto
}