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

abstract class AbstractDto implements DtoInterface
{
    /**
     * @var Request
     */
    private $request;

    public function getCloneRequest(): Request
    {
        if (!$this->request) {
            $this->request = new Request();
        }

        return clone $this->request;
    }

    public static function initDto(): DtoInterface
    {
        return new static();
    }

    public function getClass(): string
    {
        return static::class;
    }
}
