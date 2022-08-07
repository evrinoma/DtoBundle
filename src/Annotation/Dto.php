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
 * @Annotation
 * @Attributes(
 *     @Attribute("method",  type="string"),
 *     @Attribute("generator",  type="string")
 * )
 */
final class Dto extends AbstractDto
{
    /**
     * @var string|null
     */
    public ?string $method = null;
}
