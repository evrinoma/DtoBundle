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
 */
final class Dto extends AbstractDto
{

    /**
     * @var string
     */
    public $method;

}