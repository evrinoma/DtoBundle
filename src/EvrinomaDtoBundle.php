<?php


namespace Evrinoma\DtoBundle;

use Evrinoma\DtoBundle\DependencyInjection\EvrinomaDtoBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaDtoBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaDtoBundleExtension();
        }
        return $this->extension;
    }
}