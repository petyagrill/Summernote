<?php

class Summernote
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('summernote_core_path', $config,
            $this->modx->getOption('core_path') . 'components/summernote/'
        );
        $assetsUrl = $this->modx->getOption('summernote_assets_url', $config,
            $this->modx->getOption('assets_url') . 'components/summernote/'
        );
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $connectorUrl,
            'corePath' => $corePath,
            'processorsPath' => $corePath . 'processors/',
        ), $config);
    }

}