<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'extname',
    'Configuration/TypoScript',
    'RestApi Example'
);
