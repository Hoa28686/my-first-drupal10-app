<?php
namespace Drupal\name_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NameForm extends FormBase{
    public function getFormId(){
        return 'name_module_form';
    }
    public function buildForm(array $form, FormStateInterface $form_state){
        $form['name']=[
            '#type'=>'textfield',
            '#title'=>$this->t('Your Name'),
            '#required'=>TRUE
        ];
        $form['submit']=[
            '#type'=>'submit',
            '#value'=>$this->t('Submit')
        ];
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state){
        $name=$form_state->getValue('name');
        $form_state->setRedirect('name_module.greeting',['name'=>$name]);
        \Drupal::messenger()->addMessage($this->t('Hi @name',['@name'=>$name]));
    }
}