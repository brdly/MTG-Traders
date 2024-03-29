<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 05/02/2018
 * Time: 21:58
 */

class Template {
    private $vars  = array();

    //Retrieves variables from $vars for use inside the view
    public function __get($name) {
        return $this->vars[$name];
    }

    //Sets variables from the controller to $vars
    public function __set($name, $value) {
        if($name == 'view_template_file') {
            throw new Exception("Cannot bind variable named 'view_template_file'");
        }
        $this->vars[$name] = $value;
    }

    //Renders the template file and returns the view to be displayed on the page
    public function render($view_template_file) {
        if(array_key_exists('view_template_file', $this->vars)) {
            throw new Exception("Cannot bind variable called 'view_template_file'");
        }
        extract($this->vars);
        ob_start();
        include($view_template_file);
        return ob_get_clean();
    }
}