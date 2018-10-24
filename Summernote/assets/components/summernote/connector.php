<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
}
else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var Summernote $Summernote */
$Summernote = $modx->getService('summernote', 'Summernote', $modx->getOption('summernote_core_path', null,
        $modx->getOption('core_path') . 'components/summernote/') . 'model/summernote/'
);

// handle request
$corePath = $modx->getOption('summernote_core_path', null, $modx->getOption('core_path') . 'components/summernote/');
$path = $modx->getOption('processorsPath', $Summernote->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));