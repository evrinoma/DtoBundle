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
//region SECTION: Public
    public const DEFAULT_LOOKING_REQUEST = null;
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function fillEntity($entity);

    /**
     * @return \Generator|object
     */
    public function generatorEntity();
//endregion Public

//region SECTION: Dto
    /**
     * @param Request $request
     *
     * @return DtoInterface
     */
    public static function initDto($request);

    /**
     * @param Request $request
     *
     * @return AbstractDto
     */
    public function toDto($request);
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function lookingForRequest();

    /**
     * @return string
     */
    public function getClass();

    /**
     * @return object[]
     */
    public function getEntitys();

    /**
     * @param object[] $entitys
     *
     * @return DtoInterface
     */
    public function setEntitys($entitys);
//endregion Getters/Setters
}