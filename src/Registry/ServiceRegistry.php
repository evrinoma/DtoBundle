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

namespace Evrinoma\DtoBundle\Registry;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Exception\ServiceRegistryException;

final class ServiceRegistry implements ServiceRegistryInterface
{
    /**
     * @var ServiceInterface[]
     */
    private array $services = [];

    public function addService(ServiceInterface $service): void
    {
        if (!\array_key_exists($service->tag(), $this->services)) {
            $this->services[$service->tag()] = $service;
        } else {
            throw new ServiceRegistryException('The Service '.\get_class($service).'trying to override another Service');
        }
    }

    public function fill(DtoInterface $dto): void
    {
    }
}
