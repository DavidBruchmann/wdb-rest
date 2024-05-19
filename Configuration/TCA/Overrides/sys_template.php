<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'wdb_rest',
    'Configuration/TypoScript',
    'RestApi'
);
