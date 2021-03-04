<?php

namespace Evrinoma\DtoBundle\Annotation;

/**
 * Class DtoAdapter
 * @deprecated
 * @Annotation
 * @Attributes({
 *    @Attribute("adaptors", type = "array<Evrinoma\DtoBundle\Annotation\ApartAnnotation\DtoAdapterItem>"),
 * })
 * @package Evrinoma\DtoBundle\Annotation
 */
class DtoAdapter
{
//region SECTION: Fields

    public $adaptors;
//endregion Fields
}