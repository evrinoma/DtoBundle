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
use Evrinoma\DtoBundle\Event\DtoEvent;
use Evrinoma\DtoBundle\Registry\ServiceRegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

final class FactoryDto implements FactoryDtoInterface
{
    /**
     * @var array
     */
    private array $stackRequest = [];
    /**
     * @var array
     */
    private array $stackPull = [];
    /**
     * @var Request
     */
    private Request $request;
    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;
    /**
     * @var array
     */
    private array                    $pull = [];
    /**
     * @var ServiceRegistryInterface
     */
    private ServiceRegistryInterface $serviceRegistry;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param ServiceRegistryInterface $serviceRegistry
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, ServiceRegistryInterface $serviceRegistry)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->serviceRegistry = $serviceRegistry;
    }

    /**
     * @param Request $request
     *
     * @return FactoryDtoInterface
     */
    public function pushRequest(Request $request): FactoryDtoInterface
    {
        $this->stackRequest[] = $this->request;
        $this->stackPull[] = $this->pull;

        $this->request = $request;
        $this->pull = [];

        return $this;
    }

    /**
     * @return FactoryDtoInterface
     */
    public function popRequest(): FactoryDtoInterface
    {
        $this->request = array_pop($this->stackRequest);
        $this->pull = array_pop($this->stackPull);

        return $this;
    }

    /**
     * @return DtoInterface
     */
    public function createDto(string $class): ?DtoInterface
    {
        $dto = new $class();
        if ($dto instanceof DtoInterface) {
            if ($this->request) {
                if (!$this->hasDto($dto)) {
                    $request = clone $this->request;

                    $dto = $dto::initDto();
                    $this->serviceRegistry->fill($dto);
                    $dto->toDto($request);
                    $this->push($dto);

                    $event = new DtoEvent();
                    $event->setDto($dto);
                    $this->eventDispatcher->dispatch($event);
                } else {
                    $dto = $this->getDtoByClass($class);
                }
            }
        } else {
            $dto = null;
        }

        return $dto;
    }

    /**
     * @param DtoInterface $dto
     *
     * @return bool
     */
    private function hasDto(DtoInterface $dto)
    {
        return \array_key_exists($dto->getClass(), $this->pull);
    }

    /**
     * @param DtoInterface $dto
     */
    private function push(DtoInterface $dto)
    {
        $this->pull[$dto->getClass()] = $dto;
    }

    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    private function getDtoByClass(string $class)
    {
        return $this->pull[$class];
    }

    /**
     * @return ?Request
     */
    public function getRequest(): ?Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     *
     * @return FactoryDtoInterface
     */
    public function setRequest(Request $request): FactoryDtoInterface
    {
        $this->request = $request;

        return $this;
    }
}
