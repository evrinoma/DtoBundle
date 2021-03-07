<?php


namespace Evrinoma\DtoBundle\Annotation;


abstract class AbstractDto
{
    /**
     * @Required
     * @var string
     */
    public $class;

    /**
     * @Required
     * @var string
     */
    public $generator;
}