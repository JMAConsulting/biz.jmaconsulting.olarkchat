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
5. To get the secret key required for making secure postbacks to URLs, navigate to Administer >> System Settings >> Option Groups and look for the option group named "Olark Secret". Click on Options >> Edit to view / change the secret key.
6. Configure your Olark account to post the transcript of completed chats to CiviCRM (https://www.olark.com/crm/webhook) by entering the following URLs depending on your CMS. You can also copy the URLs directly from your CMS into the Webhook integration page by navigating to Administer >> System Settings >> Option Groups, select Olark Secret, then click on Options >> Edit and copy the Olark Callback URL from the form.
   
   a. Drupal:
       http://<YOUR_SITE_NAME>/civicrm/olarkchat?snippet=4&olarksecret=<OLARK_SECRET_KEY>

   b. WordPress:
       http://<YOUR_SITE_NAME>/?page=CiviCRM&q=civicrm/olarkchat&snippet=4&olarksecret=<OLARK_SECRET_KEY>

   c. Joomla:
       http://<YOUR_SITE_NAME>/index.php?option=com_civicrm&task=civicrm/olarkchat&snippet=4&olarksecret=<OLARK_SECRET_KEY>

7. Refer to the handbook for details on how to successfully terminate a conversation so that a callback is sent to CiviCRM.


