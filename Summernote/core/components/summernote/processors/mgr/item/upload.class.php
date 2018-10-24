<?php

class SummernoteUploadProcessor extends modObjectProcessor
{

    /**
     * @return array|string
     */
    public function process()
    {

        if (!$file = $this->loadFile()) {
            return $this->failure(['title'=>$this->modx->lexicon('error'),'message'=>'Можно загружать только изображения!']);
        } else {
            $this->modx->log(1, $file);
            return $this->success(['file'=>$file]);
        }
    }

    /**
     * @return array|bool
     */
    public function loadFile()
    {
        if (!empty($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
            $exts = ['jpg','jpeg','png','gif','svg'];
            mkdir(MODX_ASSETS_PATH. 'images/uploads/',0755,true);
            $name = 'images/uploads/' . time() . "_" . $_FILES['file']['name'];
            $up_url = MODX_ASSETS_PATH . $name;
            if (move_uploaded_file($_FILES['file']['tmp_name'],$up_url )) {
                $info = pathinfo($up_url);
                if(!in_array($info['extension'],$exts)){
                    unlink($up_url);
                    return false;
                }
                return MODX_ASSETS_URL . $name;
            } else {
                return false;
            }

        }
    }

}

return 'SummernoteUploadProcessor';