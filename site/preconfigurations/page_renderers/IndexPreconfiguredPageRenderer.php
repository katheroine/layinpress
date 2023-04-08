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
            'contact_info_links_config_path' => $relativePath . '/site/config/contact_info_links.yaml',
            'base_url' => '../..',
            'subpages_url' => '',
            'assets_dir_path' => '/wp-content/themes/layinpress/site/public/assets',
            'is_debug_mode' => false,
        ];
    }

    protected function provideNavigationLinksConfigPath(): string
    {
        $wpRelativePath = __DIR__ . '/../../../../..';
        $configPath = $wpRelativePath . '/uploads/navigation_links.txt';

        if (file_exists($configPath)) {
            return $configPath;
        }

        $layinRelativePath = __DIR__ . '/../../..';
        $configPath = $layinRelativePath . '/site/config/navigation_links.yaml';

        return $configPath;
    }
}
