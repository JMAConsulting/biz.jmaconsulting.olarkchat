<?php

require_once 'CRM/Core/Page.php';

class CRM_Olarkchat_Page_OlarkCallback extends CRM_Core_Page {
  function run() {
    $chat = "";
    if (isset($_POST['data'])) {
      $json = stripslashes($_POST['data']);
      $chat = json_decode($json, true);
    }
    
    // Get the secret code from the callback
    $checkCode = CRM_Utils_Request::retrieve('olarksecret', 'String', CRM_Core_DAO::$_nullArray, FALSE, NULL, 'GET');
    // Get the secret code which is set in the database
    $secretCode = CRM_Core_OptionGroup::values('olark_secret', TRUE);

    if ($chat && ($checkCode == $secretCode['Secret Code'])) { // check if codes match
      // log messages
      foreach ($chat['items'] as $key => $elements) {
        $messages[] = $elements['nickname'].': '.$elements['body'];
      }
  
      // operator
      foreach ($chat['operators'] as $key => $elements) {
        $operators['email'] = $elements['emailAddress'];
      }
      $operators['version'] = 3;
      //operator details
      $operator = civicrm_api( 'Contact', 'get', $operators );
      $operatorName = CRM_Contact_BAO_Contact::displayName($operator['id']);

      // visitor
      $visitor['display_name'] = $chat['visitor']['fullName'];
      $visitor['email'] = $chat['visitor']['emailAddress'];
      $visitor['contact_type'] = 'Individual';
      $visitor['version'] = 3;
      $dedupeParams = CRM_Dedupe_Finder::formatParams($visitor, 'Individual');
      $dupes = CRM_Dedupe_Finder::dupesByParams($dedupeParams, 'Individual');
      if (count($dupes) == 1) {
        $visitor['contact_id'] = $dupes[0];
      } 
      elseif (count($dupes) > 1) {
        $dao = new CRM_Core_DAO_UFMatch();
        $dao->uf_name = $visitor['email'];
        if ($dao->find(TRUE)) {
          $visitor['contact_id'] = $dao->contact_id;
        }
        else { 
          $visitor['contact_id'] = $dupes[0];
        }
      }
      $contact = civicrm_api( 'Contact', 'create', $visitor );

      // create the activity
      $activityTypes = CRM_Core_PseudoConstant::activityType(TRUE, FALSE, FALSE, 'name');
      $activityParams = array(
        'activity_type_id' => array_search('Chat Activity', $activityTypes),
        'subject' => 'Chat between '.$visitor['display_name'].' and '.$operatorName,
        'status_id' => 2,
        'activity_date_time' => date('YmdHis'),
        'source_contact_id' => $operator['id'],
        'target_contact_id' => $contact['id'],
        'assignee_contact_id' => $operator['id'],
        'details' => implode('<br/>', $messages),
        'version' => 3,
      );
      $activity = civicrm_api( 'Activity', 'create', $activityParams);
    }
    parent::run();
  }
}
