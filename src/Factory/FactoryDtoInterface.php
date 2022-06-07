<?php


namespace Evrinoma\DtoBundle\Factory;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

interface FactoryDtoInterface
{

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function pushRequest(Request $request): FactoryDtoInterface;

    /**
     * @return Request|null
     */
    public function getRequest(): ?Request;

    /**
     * @return $this
     */
    public function popRequest(): FactoryDtoInterface;


    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    public function createDto(string $class): ?DtoInterface;


    /**
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest(Request $request): FactoryDtoInterface;

}