<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DtoBundle\Annotation;

/**
 * Class Dtos.
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
     *
     * @var string
     */
    public string $add;
}
