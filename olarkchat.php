<?php

require_once 'olarkchat.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function olarkchat_civicrm_config(&$config) {
  _olarkchat_civix_civicrm_config($config);
  if ($config->userFramework == 'Joomla' 
    && 'civicrm/olarkchat' == JFactory::getApplication()->input->get('task')) {
    $_SESSION['olark_temp'] = 1; 
  }
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function olarkchat_civicrm_xmlMenu(&$files) {
  _olarkchat_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function olarkchat_civicrm_install() {
  return _olarkchat_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function olarkchat_civicrm_uninstall() {
  return _olarkchat_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function olarkchat_civicrm_enable() {
  foreach (glob(__DIR__ . '/sql/*_enable.sql') as $file) {
    CRM_Utils_File::sourceSQLFile(CIVICRM_DSN, $file);
  }
  return _olarkchat_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function olarkchat_civicrm_disable() {
  foreach (glob(__DIR__ . '/sql/*_disable.sql') as $file) {
    CRM_Utils_File::sourceSQLFile(CIVICRM_DSN, $file);
  }
  return _olarkchat_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function olarkchat_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _olarkchat_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function olarkchat_civicrm_managed(&$entities) {
  return _olarkchat_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_buildForm
 */
function olarkchat_civicrm_buildForm($formName, &$form) {
  $values = $form->getVar('_values');
  if ($formName == 'CRM_Admin_Form_OptionValue' && $values['name'] == 'Secret Code') {
    $url = CRM_Utils_System::url('civicrm/olarkchat', 'snippet=4&olarksecret=', TRUE, NULL, NULL, TRUE);
    CRM_Core_Region::instance('page-body')->add(array(
      'markup' => '<table><tr id="olarkUrl"><td class="label"><label for="url">Olark Callback URL </label></td>
      <td style="padding-top:5px;"><b>'.$url.'<span id="secretcode"></span></b></td></tr></table>',
    ));
    CRM_Core_Region::instance('page-body')->add(array(
      'script' => "cj('tr.crm-admin-optionvalue-form-block-name').after(cj('#olarkUrl'));
                           var url = '".$values['value']."';
                           cj('#secretcode').html(cj('#value').val());
                           cj('#value').keyup( function() {
                             cj('#secretcode').html(cj(this).val());
                           });",
    ));
  }
}
 
      