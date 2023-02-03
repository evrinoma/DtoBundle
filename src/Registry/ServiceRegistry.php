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

use Doctrine\Common\Annotations\Reader;
use Evrinoma\DtoBundle\Annotation\Required;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Exception\ServiceRegistryException;

final class ServiceRegistry implements ServiceRegistryInterface
{
    /**
     * @var ServiceInterface[]
     */
    private array $services = [];

    private Reader $annotationReader;

    /**
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function addService(ServiceInterface $service): void
    {
        if (!\array_key_exists($service->tag(), $this->services)) {
            $this->services[$service->tag()] = $service->service();
        } else {
            throw new ServiceRegistryException('The Service '.\get_class($service).'trying to override another Service');
        }
    }

    public function fill(DtoInterface $dto): void
    {
        $reflectionObject = new \ReflectionObject($dto);
        do {
            $reflectionMethods = $reflectionObject->getMethods(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
            foreach ($reflectionMethods as $reflectionMethod) {
                $annotation = $this->annotationReader->getMethodAnnotation($reflectionMethod, Required::class);
                if ($annotation) {
                    $parameters = (new \ReflectionMethod($reflectionMethod->class, $reflectionMethod->name))->getParameters();
                    $parameter = reset($parameters);
                    $key = $parameter->getType()->getName();
                    if (\array_key_exists($key, $this->services) && $this->services[$key] instanceof $key) {
                        $service = $this->services[$key];
                        $reflectionMethod->setAccessible(true);
                        $reflectionMethod->invoke($dto, $service);
                        $reflectionMethod->setAccessible(false);
                    }
                }
            }
            $reflectionObject = $reflectionObject->getParentClass();
        } while (!(AbstractDto::class === $reflectionObject->getName() && !$reflectionObject->getParentClass()));
    }
}
