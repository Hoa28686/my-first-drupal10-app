<?php

namespace Drupal\palindrome_checker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class PalindromeForm extends FormBase {
  public function getFormId() {
    return 'palindrome_checker_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    // Input text field.
    $form['input'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter text'),
      '#default_value' => $form_state->get('input'),
      '#required' => TRUE,
      '#attributes' => [
        'placeholder' => $this->t('Type a word, phrase, or sentence'),
      ],
    ];

    // Display the result if available.
    $result = $form_state->get('result');
    if ($result) {
      $form['result'] = [
        '#markup' => '<div><strong>' . $result . '</strong></div>',
      ];
    }

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Check'),
    ];

    // Clear button to reset the form.
    $form['clear'] = [
      '#type' => 'submit',
      '#value' => $this->t('Clear'),
      '#submit' => ['::clearForm'], 
      '#limit_validation_errors' => [], 
    ];

    return $form;
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get the input value.
    $input = $form_state->getValue('input');

    // Store the input value in form state for persistence.
    $form_state->set('input', $input);

    // Clean the input by removing non-alphanumeric characters and converting to lowercase.
    $cleaned = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $input));
    $reversed = strrev($cleaned);

  
    if ($cleaned === $reversed) {
      $form_state->set('result', $this->t('✅ Yes, it is a palindrome!'));
    }
    else {
      $form_state->set('result', $this->t('❌ No, it is not a palindrome.'));
    }

    // Rebuild the form to display the result.
    $form_state->setRebuild(TRUE);
  }


  public function clearForm(array &$form, FormStateInterface $form_state) {
    // Clear the stored values from form state.
    $form_state->set('input', '');
    $form_state->set('result', NULL);

    // Redirect to the same form to completely reset it.
    $form_state->setRedirect('<current>');
  }

}