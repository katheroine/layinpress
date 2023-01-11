<?php

declare(strict_types=1);

/*
 * This file is part of the Layin package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Katheroine\LayinPress\Renderer;

use PHPUnit\Framework\TestCase;
use Katheroine\Layin\Renderer\ConcretePageRenderer;

/**
 * Twig page renderer tests.
 *
 * @package Renderer
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2022 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/katheroine/layin
 */
class TimberPageRendererTest extends TestCase
{
    private const SKIPPING_MESSAGE_TIMBER_AUTOLOADING_PROBLEMS = "Autoloading problems with WP functions used by Timber.";

    public function testTimberPageRendererClassExists()
    {
        $this->assertTrue(
            class_exists('Katheroine\LayinPress\Renderer\TimberPageRenderer')
        );
    }

    public function testRenderFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Katheroine\LayinPress\Renderer\TimberPageRenderer',
                'render'
            )
        );
    }

    public function testRenderReturnsString()
    {
        $pageRenderer = new ConcretePageRenderer();
        $pageRenderer
            ->setTemplatesDirPath('../../../vendor/katheroine/layin/tests/testing_environment/templates')
            ->setTemplateFileExtension('twig.html')
            ->setTemplateName('page');

        $result = $pageRenderer->render();

        $this->assertIsString($result);
    }

    public function testRenderWhenNoTemplateIsSet()
    {
        $pageRenderer = new TimberPageRenderer();

        // Twig doc: When the template cannot be found
        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Call to undefined function Timber\apply_filters()');

        $pageRenderer->render();
    }

    public function testRenderWhenTemplateContentIsSyntacticallyImproper()
    {
        $this->markTestSkipped(self::SKIPPING_MESSAGE_TIMBER_AUTOLOADING_PROBLEMS);

        $pageRenderer = new TimberPageRenderer();
        $pageRenderer
            ->setTemplatesDirPath('../../../vendor/katheroine/layin/tests/testing_environment/templates')
            ->setTemplateFileExtension('twig.html')
            ->setTemplateName('syntactically_improper_content');

        // Twig doc: When an error occurred during compilation.
        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Call to undefined function Timber\trailingslashit()');

        $pageRenderer->render();
    }

    public function testRenderWhenTemplateContentIsEmpty()
    {
        $this->markTestSkipped(self::SKIPPING_MESSAGE_TIMBER_AUTOLOADING_PROBLEMS);

        $pageRenderer = new TimberPageRenderer();
        $pageRenderer
            ->setTemplatesDirPath('../../../vendor/katheroine/layin/tests/testing_environment/templates')
            ->setTemplateFileExtension('twig.html')
            ->setTemplateName('empty_page');

        $actualRenderedContent = $pageRenderer->render();

        $expectedRenderedContent = "";

        $this->assertEquals($expectedRenderedContent, $actualRenderedContent);
    }

    public function testRenderWithoutTemplateSubdirPath()
    {
        $this->markTestSkipped(self::SKIPPING_MESSAGE_TIMBER_AUTOLOADING_PROBLEMS);

        $pageRenderer = new TimberPageRenderer();
        $pageRenderer
            ->setTemplatesDirPath('../../../vendor/katheroine/layin/tests/testing_environment/templates')
            ->setTemplateFileExtension('twig.html')
            ->SetTemplateName('page')
            ->setTemplateParams($this->provideTemplateParams());

        $actualRenderedContent = $pageRenderer->render();

        $expectedRenderedContent = "<!doctype html>\n"
            . "<html lang=\"en-GB\">\n"
            . "  <head>\n"
            . "    <meta charset=\"\">\n"
            . "    <meta name=\"language\" content=\"english\">\n"
            . "    <meta name=\"description\" content=\"All purpose web page layout\">\n"
            . "    <meta name=\"keywords\" content=\"layout, web page\">\n"
            . "    <meta name=\"author\" content=\"usagi <usagi@moon.com>\">\n"
            . "  </head>\n"
            . "  <body>\n"
            . "    <h1>Welcome on the home page!</h1>\n"
            . "  </body>\n"
            . "</html>\n";

        $this->assertEquals($expectedRenderedContent, $actualRenderedContent);
    }

    public function testRenderWithTemplateSubdirPath()
    {
        $this->markTestSkipped(self::SKIPPING_MESSAGE_TIMBER_AUTOLOADING_PROBLEMS);

        $pageRenderer = new TimberPageRenderer();
        $pageRenderer
            ->setTemplatesDirPath(__DIR__ . '../../../vendor/katheroine/layin/tests/testing_environment/templates')
            ->setTemplateSubdirPath('subpages/')
            ->setTemplateFileExtension('twig.html')
            ->SetTemplateName('subpage')
            ->setTemplateParams($this->provideTemplateParams());

        $actualRenderedContent = $pageRenderer->render();

        $expectedRenderedContent = "<!doctype html>\n"
            . "<html lang=\"en-GB\">\n"
            . "  <head>\n"
            . "    <meta charset=\"\">\n"
            . "    <meta name=\"language\" content=\"english\">\n"
            . "    <meta name=\"description\" content=\"All purpose web page layout\">\n"
            . "    <meta name=\"keywords\" content=\"layout, web page\">\n"
            . "    <meta name=\"author\" content=\"usagi <usagi@moon.com>\">\n"
            . "  </head>\n"
            . "  <body>\n"
            . "    <h1>Welcome on the subpage!</h1>\n"
            . "  </body>\n"
            . "</html>\n";

        $this->assertEquals($expectedRenderedContent, $actualRenderedContent);
    }

    private function provideTemplateParams(): array
    {
        return [
            'language' => 'english',
            'description' => 'All purpose web page layout',
            'keywords' => 'layout, web page',
            'author' => [
                'name' => 'usagi',
                'email' => 'usagi@moon.com'
            ]
        ];
    }
}
