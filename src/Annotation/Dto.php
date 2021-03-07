<?php

namespace Evrinoma\DtoBundle\Annotation;

/**
 * Class Dto
 *
 * @Annotation
 * @Attributes(
 *    @Attribute("method",  type = "string"),
 *    @Attribute("generator",  type = "string")
 * )
 * @package Evrinoma\DtoBundle\Annotation
 */
final class Dto extends AbstractDto
{
//region SECTION: Fields
    /**
     * @var string
     */
    public $method;
//endregion Fields
}