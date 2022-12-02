<?php
$GLOBALS['TCA']['be_users']['columns']['disable']['exclude'] = 0;
$GLOBALS['TCA']['be_users']['columns']['createdByAction']['config']['type'] = 'passthrough';

$tempColumns = [
  'createdByAction' => [
    'label' => 'createdByAction',
    'config' => [
      'type' => 'passthrough',
    ]
  ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $tempColumns);
