<?php

namespace Drupal\palindrome_checker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Form;

class PalindromeForm extends FormBase{
    public function getFormId()
    {
    return 'palindrome_checker_form';
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['input']=[
            '#type'=>'textfield',
            '#default_value' => $form_state->get('input'),
            '#required'=>TRUE,
            '#attributes'=>[
                'placeholder'=>$this->t('Type a word, phrase or sentence')
            ]
            ];
        
        $result=$form_state->get('result');
        if($result){
            $form['result']=[
                '#markup'=>"<div><strong>$result</strong></div>",
            ];
        }
        $form['submit']=[
            '#type'=>'submit',
            '#value'=>$this->t('Check'),
        ];
        $form['clear']=[
            '#type'=>'submit',
            '#value'=>$this->t('Clear text'),
            '#submit'=>['::clearForm'],
            '#limit_validation_errors'=> [],
            '#name'=>'clear'

        ];
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $input=$form_state->getValue('input');
        $form_state->setValue('input', $input);

        $cleaned=trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', "",$input)));
        $reversed=strrev($cleaned);
        if($input!==''){
            if($cleaned===$reversed){
            $form_state->set('result',$this->t('✅ Yes, It is a palindrome!'));
            }else{
            $form_state->set('result',$this->t('❌ No, not a palindrome!'));

        }}
        // rebuild form to show result instead of redirect
        $form_state->setRebuild(TRUE);
        
    }
    public function clearForm( array &$form,FormStateInterface $form_state){
        // Clear the input field value.
        
        $form_state->set('input', '');
        $form_state->setUserInput([]);
        // Clear the result message.
        $form_state->set('result', null);
        
        // Rebuild the form to reflect the cleared state.
        $form_state->setRebuild(TRUE);
    }
}