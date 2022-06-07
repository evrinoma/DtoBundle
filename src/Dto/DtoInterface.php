<?php

namespace Evrinoma\DtoBundle\Dto;

use Symfony\Component\HttpFoundation\Request;

interface DtoInterface
{

    public const DTO_CLASS = 'class';


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

}