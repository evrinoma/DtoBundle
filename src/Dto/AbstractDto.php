<?php

namespace Evrinoma\DtoBundle\Dto;


use Evrinoma\DtoBundle\Core\DtoTrait;
use Evrinoma\DtoBundle\Factory\FactoryAdaptor;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractDto
 *
 * @package Evrinoma\DtoBundle\Dto
 */
abstract class AbstractDto implements DtoInterface
{

    use DtoTrait;

//region SECTION: Fields
    /**
     * @var AbstractDto[]
     */
    private $clones = [];
    /**
     * @var
     */
    private $entitys;
    /**
     * @var FactoryAdaptor $factoryAdapter
     */
    private $factoryAdapter;
//endregion Fields

//region SECTION: Protected
    /**
     * @return mixed
     */
    abstract protected function getClassEntity();

    /**
     * @param Request $request
     *
     * @return Request
     */
    protected function regenerateRequest(Request $request)
    {
        $target = $this->getTarget($request);
        $class = $request->get('class');
        if ($class !== $this->getClassEntity() && $target) {
            if (is_string($target)) {
                $target = json_decode($target, true);
            }
            if ($target && is_array($target) && count($target) > 0) {
                $request->isMethod('POST') ? $request->request->add($target) : $request->query->add($target);
            }
        } else {
            $restApi = $request->get($this->getClass());
            if (is_array($restApi)) {
                $restApi += ['class' => $this->getClassEntity()];
                $request->isMethod('POST') ? $request->request->add($restApi) : $request->query->add($restApi);
            }
        }

        return $request;
    }
//endregion Protected

//region SECTION: Public
    /**
     * @return \Generator|object
     */
    public function generatorClone()
    {
        foreach ($this->clones as $clone) {
            yield $clone;
        }
    }

    /**
     * @return AbstractDto
     */
    public function clone()
    {
        $clone          = clone $this;
        $clone->clones  = null;
        $this->clones[] = &$clone;

        return $clone;
    }

    /**
     * @return \Generator|object
     */
    public function generatorEntity()
    {
        foreach ($this->entitys as $entity) {
            yield $entity;
        }
    }

    /**
     * @return int
     */
    public function countEntity()
    {
        return count($this->entitys);
    }

    /**
     * @return bool
     */
    public function hasSingleEntity()
    {
        return $this->countEntity() === 1;
    }

    /**
     * @return int
     */
    public function countClone()
    {
        return count($this->clones);
    }
//endregion Public

//region SECTION: Private
    /**
     * @param Request $request
     *
     * @return mixed|null
     */
    private function getTarget(Request $request)
    {
        if ($this->lookingForRequest() !== null) {
            return $request->get($this->lookingForRequest());
        }

        return null;
    }
//endregion Private

//region SECTION: Dto
    /**
     * @param Request $request
     *
     * @return DtoInterface
     */
    public static function initDto($request)
    {
        $dto = new static();
        $dto->regenerateRequest($request);

        return $dto;
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @return object[]
     */
    public function getEntitys()
    {
        return $this->entitys;
    }

    /**
     * @return FactoryAdaptor
     */
    public function getFactoryAdapter()
    {
        return $this->factoryAdapter;
    }

    /**
     * @param object[] $entitys
     *
     * @return DtoInterface
     */
    public function setEntitys($entitys)
    {
        $this->entitys = $entitys;

        return $this;
    }

    /**
     * @param FactoryAdaptor $factoryAdapter
     */
    public function setFactoryAdapter(&$factoryAdapter)
    {
        $this->factoryAdapter = &$factoryAdapter;
    }
//endregion Getters/Setters
}