 <?php
/**
 * Created by PhpStorm.
 * User: pg
 * Date: 24.10.18
 * Time: 5:58
 */

switch ($modx->event->name){
    case 'OnRichTextEditorRegister':
        $modx->event->output('Summernote');
        return;
        break;
    case 'OnDocFormPrerender':
        if ($modx->getOption('which_editor', null, 'Summernote') !== 'Summernote') {
            return;
        }
        if (!$modx->controller->resourceArray) {
            return;
        }
        $Summernote = $modx->getService('summernote', 'Summernote', $modx->getOption('summernote_core_path', null, $modx->getOption('core_path') . 'components/summernote/') . 'model/summernote/', []);
        $modx->regClientStartupHTMLBlock('<link rel="stylesheet" href="'.$Summernote->config['cssUrl'] . 'mgr/summernote-lite.css" />');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript" src="'.$Summernote->config['jsUrl'] . 'mgr/jquery.min.js"></script> ');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript" src="'.$Summernote->config['jsUrl'] . 'mgr/summernote-lite.js"></script> ');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript" src="'.$Summernote->config['jsUrl'] . 'mgr/summernote-ru-RU.min.js"></script> ');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">
                var Summernote = '.json_encode($Summernote->config) .' 
            </script> ');
        $modx->regClientStartupHTMLBlock('<script type="text/javascript" src="'.$Summernote->config['jsUrl'] . 'mgr/summernote.js"></script> ');
        break;
}