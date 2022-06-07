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

namespace Evrinoma\DtoBundle\Event;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Contracts\EventDispatcher\Event;

class DtoEvent extends Event
{
    /**
     * @var DtoInterface
     */
    private DtoInterface $dto;

    /**
     * @return mixed
     */
    public function getDto()
    {
        return $this->dto;
    }

    /**
     * @param mixed $dto
     *
     * @return DtoEvent
     */
    public function setDto($dto)
    {
        $this->dto = $dto;

        return $this;
    }
}
