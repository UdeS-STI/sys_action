<?php

declare(strict_types=1);

defined('TYPO3') || die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['taskcenter']['sys_action'][\TYPO3\CMS\SysAction\ActionTask::class] = [
    'title' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_tca.xlf:sys_action',
    'description' => 'LLL:EXT:sys_action/Resources/Private/Language/locallang_csh_sysaction.xlf:.description',
    'icon' => 'EXT:sys_action/Resources/Public/Images/x-sys_action.png',
];
