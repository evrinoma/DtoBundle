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

class DtoAnnotationSubscriber implements EventSubscriberInterface
{
    private Reader $annotationReader;

    /**
     * @var FactoryDto
     */
    private FactoryDto $factoryDto;

    /**
     * @param Reader     $annotationReader
     * @param FactoryDto $factoryDto
     */
    public function __construct(Reader $annotationReader, FactoryDto $factoryDto)
    {
        $this->annotationReader = $annotationReader;
        $this->factoryDto = $factoryDto;
    }

    /**
     * @param $dto
     */
    private function handleAnnotation($dto): void
    {
        $reflectionObject = new ReflectionObject($dto);
        do {
            $reflectionProperties = $reflectionObject->getProperties(ReflectionProperty::IS_PRIVATE);
            foreach ($reflectionProperties as $reflectionProperty) {
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Dto::class);
                if ($annotation) {
                    foreach ($dto->{$annotation->generator}($this->factoryDto->getRequest()) as $request) {
                        $annotationDto = $this->factoryDto->pushRequest($request)->createDto($annotation->class);
                        $this->factoryDto->popRequest();
                        $methodCall = ($annotation->method) ?: 'set'.ucfirst($reflectionProperty->getName());
                        $dto->{$methodCall}($annotationDto);
                    }
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Dtos::class);
                if ($annotation) {
                    foreach ($dto->{$annotation->generator}($this->factoryDto->getRequest()) as $request) {
                        $annotationDto = $this->factoryDto->pushRequest($request)->createDto($annotation->class);
                        $this->factoryDto->popRequest();
                        $dto->{$annotation->add}($annotationDto);
                    }
                }
            }
            $reflectionObject = $reflectionObject->getParentClass();
        } while (!(AbstractDto::class === $reflectionObject->getName() && !$reflectionObject->getParentClass()));
    }

    /**
     * @param DtoEvent $event
     */
    public function onKernelDto(DtoEvent $event): void
    {
        $dto = $event->getDto();

        $this->handleAnnotation($dto);
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            DtoEvent::class => 'onKernelDto',
        ];
    }
}
