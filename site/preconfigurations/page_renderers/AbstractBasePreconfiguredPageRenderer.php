<?php

/*
 * This file is part of the LayinPress package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Katheroine\LayinPress\Preconfiguration;

use Katheroine\Layin\Renderer\AbstractPageRenderer;
use Katheroine\Layin\Renderer\AbstractVioletPreconfiguredPageRenderer;
use Katheroine\LayinPress\Renderer\TimberPageRenderer;

abstract class AbstractBasePreconfiguredPageRenderer extends AbstractVioletPreconfiguredPageRenderer
{
    protected function providePageRenderer(): AbstractPageRenderer
    {
        return new TimberPageRenderer();
    }

    abstract protected function providePreconfiguration(): array;
}
