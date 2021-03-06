<?php


namespace Evrinoma\DtoBundle\Factory;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

interface FactoryDtoInterface
{
//region SECTION: Public
    /**
     * @param Request $request
     *
     * @return $this
     */
    public function pushRequest(Request $request): FactoryDtoInterface;

    /**
     * @return $this
     */
    public function popRequest(): FactoryDtoInterface;
//endregion Public

//region SECTION: Dto
    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    public function createDto(string $class): ?DtoInterface;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest(Request $request): FactoryDtoInterface;
//endregion Getters/Setters
}