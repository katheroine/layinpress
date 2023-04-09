<?php

/*
 * This file is part of the LayinPress package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Katheroine\LayinPress\Renderer;

use Katheroine\Layin\Renderer\AbstractPageRenderer;
use Timber\Timber;

/**
 * Timber page renderer.
 *
 * @package Renderer
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2022 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/katheroine/layin
 */
class TimberPageRenderer extends AbstractPageRenderer
{
    private array $additionalTemplateParams = [];

    public function addTemplateParam(string $paramName, $paramValue): void
    {
        $this->additionalTemplateParams[$paramName] = $paramValue;
    }

    public function render()
    {
        Timber::$dirname = $this->templatesDirPath;
        $context = Timber::context();

        try {
            ob_start(); // Doesn't allow to echo rendered template.
            Timber::render($this->buildTemplatePath(), array_merge(
                $context,
                $this->buildTemaplateParams()
            ));
        } catch (\Exception $exception) {
            ob_flush();
            throw $exception;
        } finally {
            $content = ob_get_contents();
            ob_end_clean();
        }

        return $content;
    }

    private function buildTemplatePath(): string
    {
        return $this->templateSubdirPath
            . $this->templateName
            . '.'
            . $this->templateFileExtension;
    }

    private function buildTemaplateParams(): array
    {
        return array_merge(
            $this->templateParams,
            $this->additionalTemplateParams
        );
    }
}
