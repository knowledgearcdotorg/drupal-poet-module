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
    public function getFormId()
    {
        return 'drupal_poet_module_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $connection = \Drupal::database();
        $query = $connection->query("SELECT frost_url, token FROM token_url ORDER BY id DESC LIMIT 1");
        $result = $query->fetchAssoc();
        if ($result['frost_url']) {
            $frost_url = $result['frost_url'];

        } else {
            $frost_url = $result['frost_url'];
        }
        if ($result['token']) {
            $token = $result['token'];

        } else {
            $token = $result['token'];
        }
        $form['frost_url'] = array(
            '#type' => 'textfield', //you can find a list of available types in the form api
            '#title' => 'Frost URL',
            '#size' => 50,
            '#value' => $frost_url,
            '#maxlength' => 1000,
            '#required' => TRUE, //make this field required
        );
        $form['token'] = array(
            '#type' => 'textfield', //you can find a list of available types in the form api
            '#title' => 'Frost Token',
            '#size' => 50,
            '#value' => $token,
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
    public function validateForm(array &$form, FormStateInterface $form_state)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $url = $form_state->getValue('frost_url');
        $token = $form_state->getValue('token');
        $connection = \Drupal::database();
        $connection->insert('token_url')->fields(['frost_url' => $url, 'token' => $token])->execute();
        drupal_set_message(t('Credentials Added Successfully'), 'status', TRUE);
    }

}
