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
 */
final class Dtos extends AbstractDto
{

    /**
     * @Required
     * @var string
     */
    public $add;

}