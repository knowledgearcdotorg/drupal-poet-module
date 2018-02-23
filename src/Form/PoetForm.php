<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/23/18
 * Time: 2:43 PM
 */

namespace Drupal\drupal_poet_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class PoetForm extends FormBase
{
    public function getFormId() {
        return 'drupal_poet_module_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['frost_url'] = array(
            '#type' => 'textfield', //you can find a list of available types in the form api
            '#title' => 'Frost URL',
            '#size' => 50,
            '#maxlength' => 1000,
            '#required' => TRUE, //make this field required
        );
        $form['token'] = array(
            '#type' => 'textfield', //you can find a list of available types in the form api
            '#title' => 'Frost Token',
            '#size' => 50,
            '#maxlength' => 1000,
            '#required' => TRUE, //make this field required
        );

        $form['save'] = array(
            '#type' => 'submit',
            '#input' => TRUE,
            '#value' => 'save'

        );
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $url=$form_state->getValue('frost_url');
        $token=$form_state->getValue('token');
        $connection = \Drupal::database();
        $connection->insert('drupal8.token_url')->fields(['frost_url' => $url,'token'=> $token])->execute();

    }

}