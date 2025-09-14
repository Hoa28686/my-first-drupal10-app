<?php

namespace Drupal\name_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

use Drupal\Core\Link;
use Drupal\Core\Url;

class NameController extends ControllerBase{
    public function name($name){
        return new Response('Hello '.$name);
    }
    public function content($name){
        $url = Url::fromRoute('name_module.form');
        $link = Link::fromTextAndUrl($this->t('Go to the form'),$url)->toString();
    
        return [

            '#markup'=>$this->t('Hello, @name! @link',['@link'=>$link,
            '@name'=>$name]),
        ];
    }
    public function greeting($name){
        return [

            '#markup'=>$this->t('Hello, @name!',[
            '@name'=>$name]),
        ];
    }
}