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

namespace Evrinoma\MenuBundle\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class ExampleTest.
 */
class ExampleTest extends TestCase
{
    private function example($a)
    {
        $b = 3;

        return $a * $b;
    }

    public function testAdd()
    {
        $result = $this->example(2);
        $this->assertEquals(6, $result);

        $result = $this->example(3);
        $this->assertEquals(9, $result);
    }
}
