<?php

namespace engine\core\template;

use engine\core\template\theme;

class view
{
    protected $theme;

    public function __construct()
    {
        $this->theme = new theme();
    }

    /**
     * @param $template
     * @param array $vars
     * @throws \Exception
     */
    public function render($template, $vars = [])
    {
        $templatePath = ROOT_DIR.'/content/themes/default/'.$template.'.php';

        if(!is_file($templatePath))
        {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in "%s"',
                $template, $templatePath));
        }

        $this->theme->setData($vars);

        extract($vars);

        ob_start();
        ob_implicit_flush(0);

        try{
            require $templatePath;
        }catch (\Exception $e){
            ob_end_clean();
            throw $e;
        }
        echo ob_get_clean();
    }
}