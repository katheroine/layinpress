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

class IndexPreconfiguredPageRenderer extends AbstractBasePreconfiguredPageRenderer
{
    protected const WP_RELATIVE_PATH = __DIR__ . '/../../../../..';
    protected const LAYIN_RELATIVE_PATH = __DIR__ . '/../../..';

    protected function providePreconfiguration(): array
    {
        $relativePath = __DIR__ . '/../../..';

        return [
            'templates_dir_path' => './site/templates/',
            'template_subdir_path' => '',
            'template_file_extension' => 'timber.html',
            'page_file_extension' => 'php',
            'site_config_path' => $relativePath . '/site/config/site_config.yaml',
            'navigation_links_config_path' => $this->provideNavigationLinksConfigPath(),
            'contact_info_links_config_path' => $this->provideContactInfoLinksConfigPath(),
            'base_url' => '../..',
            'subpages_url' => '',
            'assets_dir_path' => '/wp-content/themes/layinpress/site/public/assets',
            'is_debug_mode' => false,
        ];
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
