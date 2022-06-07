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

namespace Evrinoma\DtoBundle\Dto;

use Symfony\Component\HttpFoundation\Request;

interface DtoInterface
{
    public const DTO_CLASS = 'class';

    /**
     * @return DtoInterface
     */
    public static function initDto(): DtoInterface;

    /**
     * @return AbstractDto
     */
    public function toDto(Request $request): DtoInterface;
}
