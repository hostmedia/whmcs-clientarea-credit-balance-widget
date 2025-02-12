<?php

/**
 * Name: WHMCS Client Credit Widget
 * Description: This hook provides your customers with an easy to view panel on the client areas home page displaying their credit balance.
 * Version 1.0
 * Created by Host Media Ltd
 * Website: https://hostmedia.uk/
 */

add_hook('ClientAreaHomepagePanels', 1, function($homePagePanels) {

  // Get the client data and check ID is valid
  $client = Menu::context("client");
  $clientId = intval($client->id);
  if ($clientId === 0) {return;}

  $newPanel = $homePagePanels->addChild(
      'clientCreditWidget',
      array(
          'name' => 'Account Credit',
          'label' => Lang::trans('statscreditbalance'),
          'icon' => 'fas fa-money-bill', // Full list of icons: https://fontawesome.com/v5/icons/
          'order' => '99',
          'extras' => array(
              'color' => 'orange', // See Panel Accents in template styles.css
              'btn-link' => '/clientarea.php?action=addfunds',
              'btn-text' => Lang::trans('addfunds'),
              'btn-icon' => 'fas fa-plus',
          ),
      )
  );

  $newPanel->addChild(
      'clientCreditWidget-content',
      array(
          'label' => '<h3 class="text-center pt-3 pb-2">' . formatcurrency($client->credit, $client->currencyId) . '</h3>',
          'uri' => '/clientarea.php?action=addfunds',
          'order' => 1,
      )
  );
});
