<?php

namespace Evrinoma\DtoBundle\Subscriber;


use Doctrine\Common\Annotations\Reader;
use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\DtoBundle\Annotation\Dtos;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Event\DtoEvent;
use Evrinoma\DtoBundle\Factory\FactoryDto;
use ReflectionObject;
use ReflectionProperty;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DtoAnnotationListener
 *
 * @package Evrinoma\DtoBundle\Listener
 */
class DtoAnnotationSubscriber implements EventSubscriberInterface
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
    private function handleAnnotation($dto): void
    {
        $reflectionObject = new ReflectionObject($dto);
        do {
            $reflectionProperties = $reflectionObject->getProperties(ReflectionProperty::IS_PRIVATE);
            foreach ($reflectionProperties as $reflectionProperty) {
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Dto::class);
                if ($annotation) {
                    {
                        foreach ($dto->{$annotation->generator}($this->factoryDto->getRequest()) as $request) {
                            $annotationDto = $this->factoryDto->pushRequest($request)->createDto($annotation->class);
                            $this->factoryDto->popRequest();
                            $methodCall = ($annotation->method) ?: 'set'.ucfirst($reflectionProperty->getName());
                            $dto->{$methodCall}($annotationDto);
                        }
                    }
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Dtos::class);
                if ($annotation) {
                    {
                        foreach ($dto->{$annotation->generator}($this->factoryDto->getRequest()) as $request) {
                            $annotationDto = $this->factoryDto->pushRequest($request)->createDto($annotation->class);
                            $this->factoryDto->popRequest();
                            $dto->{$annotation->add}($annotationDto);
                        }
                    }
                }
            }
            $reflectionObject = $reflectionObject->getParentClass();
        } while (!($reflectionObject->getName() === AbstractDto::class && !$reflectionObject->getParentClass()));
    }
//endregion Private

//region SECTION: Dto
    public function onKernelDto(DtoEvent $event): void
    {
        $dto = $event->getDto();

        $this->handleAnnotation($dto);
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            DtoEvent::class => 'onKernelDto',
        ];
    }
//endregion Getters/Setters
}