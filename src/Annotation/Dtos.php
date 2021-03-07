<?php

namespace Evrinoma\DtoBundle\Annotation;

/**
 * Class Dtos
 *
 * @Annotation
 * @Attributes(
 *    @Attribute("generator",  type = "string"),
 *    @Attribute("add",  type = "string")
 * )
 * @package Evrinoma\DtoBundle\Annotation
 */
final class Dtos extends AbstractDto
{
//region SECTION: Fields
    /**
     * @Required
     * @var string
     */
    public $add;
//endregion Fields
}