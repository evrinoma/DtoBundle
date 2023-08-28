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

use Evrinoma\DtoBundle\Annotation\Required;
use Evrinoma\DtoBundle\Service\Identity\IdentityInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractDto implements DtoInterface
{
    private ?Request $request = null;

    private ?IdentityInterface $identityService = null;

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

    /**
     * @Required
     */
    protected function setIdentityService(IdentityInterface $identityService): DtoInterface
    {
        $this->identityService = $identityService;

        return $this;
    }

    public function getClass(): string
    {
        return $this->identityService->getIdentity(static::class);
    }

    public function toRequest(array $data, string $class): Request
    {
        $request = $this->getCloneRequest();
        $data[DtoInterface::DTO_CLASS] = $this->identityService->getIdentity($class);
        $request->request->add($data);

        return $request;
    }
}
