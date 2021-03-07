<?php

namespace Evrinoma\DtoBundle\Adaptor;

interface EntityAdaptorInterface
{
//region SECTION: Public
    /**
     * @param $entity
     */
    public function fillEntity($entity): void;

//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function getClassEntity(): string;
//endregion Getters/Setters
}