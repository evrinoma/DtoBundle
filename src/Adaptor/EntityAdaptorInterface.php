<?php

namespace Evrinoma\DtoBundle\Adaptor;

interface EntityAdaptorInterface
{

    /**
     * @param $entity
     */
    public function fillEntity($entity): void;


    /**
     * @return string
     */
    public function getClassEntity(): string;

}