<?php

namespace Evrinoma\DtoBundle\Factory;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Event\DtoEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

final class FactoryDto implements FactoryDtoInterface
{

    private $stackRequest = [];
    private $stackPull    = [];
    private $request;
    private $eventDispatcher;
    private $pull         = [];


    /**
     * FactoryDto constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function pushRequest(Request $request): FactoryDtoInterface
    {
        $this->stackRequest[] = $this->request;
        $this->stackPull[]    = $this->pull;


        $this->request = $request;
        $this->pull    = [];

        return $this;
    }

    public function popRequest(): FactoryDtoInterface
    {
        $this->request = array_pop($this->stackRequest);
        $this->pull    = array_pop($this->stackPull);

        return $this;
    }


//region SECTION: Private
    /**
     * @param $dto DtoInterface
     */
    private function push($dto)
    {
        $this->pull[$dto->getClass()] = $dto;

    }

    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    private function getDtoByClass($class)
    {
        return $this->pull[$class];
    }
//endregion Private


    /**
     * @param string $class
     *
     * @return DtoInterface
     */
    public function createDto(string $class): ?DtoInterface
    {
        $dto = new $class;
        if ($dto instanceof DtoInterface) {
            if ($this->request) {
                if (!$this->hasDto($dto)) {
                    $request = clone $this->request;

                    $dto = $dto::initDto();
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
    private function hasDto($dto)
    {
        return array_key_exists($dto->getClass(), $this->pull);
    }


    public function getRequest(): ?Request
    {
        return $this->request;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest(Request $request): FactoryDtoInterface
    {
        $this->request = $request;

        return $this;
    }

}