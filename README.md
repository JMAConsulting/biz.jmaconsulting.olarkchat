Olark Chat Extension for CiviCRM
================================

Olark is a chat service that enables web site visitors to chat with staff of an organization. It has a good set of features for services in this space (http://www.olark.com/features). This extension integrates the service with CiviCRM by posting chat transcripts as CiviCRM activities attached to the visitor's existing or newly created contact record and assigned to the relevant staff person's record. 

Installation
============

1. Create an Olark account.
2. Follow the installation instructions for Olark at https://www.olark.com/help/handbook, specifically to paste a snippet into your site to offer and display the chat window. (https://www.olark.com/settings/code)
2. As part of your general CiviCRM installation, you should set a CiviCRM Extensions Directory at Administer >> System Settings >> Directories.
2. As part of your general CiviCRM installation, you should set an Extension Resource URL at Administer >> System Settings >> Resource URLs.
3. Navigate to Administer >> System Settings >> Manage Extensions.
4. Beside Olark Chat, click Install.
5. Configure your Olark account to post the transcript of completed chats to CiviCRM by entering the following URLs depending on your CMS. (https://www.olark.com/crm/webhook)
   
   a. Drupal:
       http://<YOUR_SITE_NAME>/civicrm/olarkchat?snippet=4

   b. WordPress:
       http://<YOUR_SITE_NAME>/?page=CiviCRM&q=civicrm/olarkchat&snippet=4

   c. Joomla:
       http://<YOUR_SITE_NAME>/index.php?option=com_civicrm&task=civicrm/olarkchat&snippet=4 

6. Refer to the handbook for details on how to successfully terminate a conversation so that a callback is sent to CiviCRM.


