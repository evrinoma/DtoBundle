<?php

namespace Evrinoma\DtoBundle\Subscriber;

use Doctrine\Common\Annotations\Reader;
use Evrinoma\DtoBundle\Annotation\ApartAnnotation\DtoAdapterItem;
use Evrinoma\DtoBundle\Annotation\DtoAdapter;
use Evrinoma\DtoBundle\Event\DtoAdapterEvent;
use Evrinoma\DtoBundle\Factory\FactoryDto;
use ReflectionObject;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DtoAdapterAnnotationSubscriber
 *
 * @package Evrinoma\DtoBundle\Subscriber
 * @deprecated
 */
class DtoAdapterAnnotationSubscriber implements  EventSubscriberInterface
{
//region SECTION: Fields
    private $annotationReader;

    /**
     * FactoryDto
     */
    private $factoryDto;

//endregion Fields

//region SECTION: Constructor
    public function __construct(Reader $annotationReader, FactoryDto $factoryDto)
    {
        $this->annotationReader = $annotationReader;
        $this->factoryDto       = $factoryDto;
    }
//endregion Constructor

//region SECTION: Public
//endregion Public

//region SECTION: Private
    private function handleAnnotation($dto, $class)
    {
        $dtoTo = null;

        $reflectionObject  = new ReflectionObject($dto);
        $reflectionMethods = $reflectionObject->getMethods();

        foreach ($reflectionMethods as $reflectionMethod) {
            $annotations = $this->annotationReader->getMethodAnnotation($reflectionMethod, DtoAdapter::class);
            if ($annotations instanceof DtoAdapter) {
                /** @var DtoAdapterItem $adaptor */
                foreach ($annotations->adaptors as $adaptor) {
                    if ($adaptor->class === $class) {
                        $dtoTo = $this->factoryDto->cloneDto($class);
                        $dtoTo->{$adaptor->method}($dto->{$reflectionMethod->getName()}());

                        return $dtoTo;
                    }
                }
            }
        }

        return $dtoTo;
    }
//endregion Private

//region SECTION: Dto
    public function onKernelDto(DtoAdapterEvent $event): void
    {
        $dtoTo = $this->handleAnnotation($event->getDtoFrom(), $event->getClass());
        $event->setDtoTo($dtoTo);
    }
//endregion SECTION: Dto

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            DtoAdapterEvent::class => 'onKernelDto',
        ];
    }
}