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

trait ConfigurableTrait
{
    protected const WP_RELATIVE_PATH = __DIR__ . '/../../../../..';
    protected const LAYIN_RELATIVE_PATH = __DIR__ . '/../../..';

    protected function provideSiteConfigPath(): string
    {
        return $this->provideConfigPath('site_config');
    }

    protected function provideNavigationLinksConfigPath(): string
    {
        return $this->provideConfigPath('navigation_links');
    }

    protected function provideContactInfoLinksConfigPath(): string
    {
        return $this->provideConfigPath('contact_info_links');
    }

    protected function provideConfigPath(string $configName): string
    {
        $configPath = self::WP_RELATIVE_PATH . '/uploads/' . $configName . '.txt';

        if (file_exists($configPath)) {
            return $configPath;
        }

        $configPath = self::LAYIN_RELATIVE_PATH . '/site/config/' . $configName . '.yaml';

        return $configPath;
    }
}
