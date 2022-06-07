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

namespace Evrinoma\DtoBundle;

use Evrinoma\DtoBundle\DependencyInjection\EvrinomaDtoBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaDtoBundle extends Bundle
{
    public const DTO_BUNDLE = 'dto';

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaDtoBundleExtension();
        }

        return $this->extension;
    }
}
