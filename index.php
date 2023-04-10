<?php

require_once __DIR__ . '/vendor/autoload.php';

use Katheroine\LayinPress\Preconfiguration\LayinPressPreconfiguredPageRenderer;

$pageRenderer = new LayinPressPreconfiguredPageRenderer();
$pageRenderer->setTemplateName('index.layinpress');

echo $pageRenderer->render();
