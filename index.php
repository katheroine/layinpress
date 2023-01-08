<?php

require_once __DIR__ . '/vendor/autoload.php';

use Katheroine\LayinPress\Preconfiguration\IndexPreconfiguredPageRenderer;

$pageRenderer = new IndexPreconfiguredPageRenderer();
$pageRenderer->setTemplateName('index.layinpress');

echo $pageRenderer->render();
