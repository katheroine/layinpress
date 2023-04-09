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

use Katheroine\Layin\Loader\ConfiguredSeriesLoader;

class IndexPreconfiguredPageRenderer extends AbstractBasePreconfiguredPageRenderer
{
    use ConfigurableTrait;

    protected function providePreconfiguration(): array
    {
        return [
            'templates_dir_path' => './site/templates/',
            'template_subdir_path' => '',
            'template_file_extension' => 'timber.html',
            'page_file_extension' => 'php',
            'site_config_path' => $this->provideSiteConfigPath(),
            'navigation_links_config_path' => $this->provideNavigationLinksConfigPath(),
            'contact_info_links_config_path' => $this->provideContactInfoLinksConfigPath(),
            'base_url' => '../..',
            'subpages_url' => '',
            'assets_dir_path' => '/wp-content/themes/layinpress/site/public/assets',
            'is_debug_mode' => false,
        ];
    }

    protected function provideSideLinks(): array
    {
        $sideLinksLoader = new ConfiguredSeriesLoader($this->provideSideLinksPath());
        $sideLinks = $sideLinksLoader->load();

        return $sideLinks;
    }
}
