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

namespace Evrinoma\DtoBundle\Factory;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

interface FactoryDtoInterface
{
    /**
     * @return $this
     */
    public function pushRequest(Request $request): FactoryDtoInterface;

    public function getRequest(): ?Request;

    /**
     * @return $this
     */
    public function popRequest(): FactoryDtoInterface;

    /**
     * @return DtoInterface
     */
    public function createDto(string $class): ?DtoInterface;

    /**
     * @return $this
     */
    public function setRequest(Request $request): FactoryDtoInterface;
}
