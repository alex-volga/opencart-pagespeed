<?php
class ControllerCommonAssets extends Controller {

    public function js() {
        if (isset($this->request->get['js'])) {
            $file = DIR_APPLICATION.'../assets/'.$this->request->get['js'].'.js';
            if (file_exists($file)) {
                if (extension_loaded('zlib')) {
                    ob_start('ob_gzhandler');
                }
                echo file_get_contents($file);
                $js = ob_get_contents();
                if (extension_loaded('zlib')) {
                    ob_end_clean();
                }
                $this->response->addHeader('Content-type: text/javscript');
                $this->response->addHeader('Last-Modified: '.date('r', filemtime($file)));
                $this->response->addHeader('Expires: '.date('r', time() + 3600 * 24 * 30));
                $this->response->setCompression(9);
                $this->response->setOutput($js);
            }
        }
    }
}
