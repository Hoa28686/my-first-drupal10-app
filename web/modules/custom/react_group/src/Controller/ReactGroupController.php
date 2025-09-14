<?php

namespace Drupal\react_group\Controller;

use Drupal\Core\Controller\ControllerBase;

class ReactGroupController extends ControllerBase{
    public function content(){
        return [
            "#markup"=>'<div id="react-group"></div>',
            "#attached"=>["library"=>["react_group/react_group"]]
        ];
    }
}