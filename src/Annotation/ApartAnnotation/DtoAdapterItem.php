<?php

namespace Evrinoma\DtoBundle\Annotation\ApartAnnotation;

/**
 * Class DtoAdapterItem
 *
 * @Annotation
 * @Attributes(
 *    @Attribute("class",  type = "string"),
 *    @Attribute("method",  type = "string")
 * )
 * @package Evrinoma\DtoBundle\Annotation\ApartAnnotation
 */
class DtoAdapterItem
{
//region SECTION: Fields
    public $class;
    public $method;
//endregion Fields
}