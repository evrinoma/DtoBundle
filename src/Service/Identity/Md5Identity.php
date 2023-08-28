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

namespace Evrinoma\DtoBundle\Service\Identity;

use Evrinoma\DtoBundle\Registry\ServiceInterface;

final class Md5Identity implements ServiceInterface, IdentityInterface
{
    private array $lazy = [];

    public function getIdentity(string $class): string
    {
        if (!\array_key_exists($class, $this->lazy)) {
            $this->lazy[$class] = md5($class);
        }

        return $this->lazy[$class];
    }

    public function service()
    {
        return $this;
    }

    public function tag(): string
    {
        return IdentityInterface::class;
    }
}
