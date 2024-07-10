<?php

declare(strict_types=1);

namespace TYPO3\CMS\SysAction;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Backend\RecordList\DatabaseRecordList;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class for the list rendering of Web>Task Center module
 * @internal
 */
class ActionList extends DatabaseRecordList
{
    /**
     * Creates the URL to this script, including all relevant GPvars
     * Fixed GPvars are id, table, imagemode, returnUrl, search_field, search_levels and showLimit
     * The GPvars "sortField" and "sortRev" are also included UNLESS they are found in the $excludeList variable.
     *
     * @param string $alternativeId Alternative id value. Enter blank string for the current id ($this->id)
     * @param string $table Table name to display. Enter "-1" for the current table.
     * @param string $excludeList Comma separated list of fields NOT to include ("sortField" or "sortRev")
     * @return string
     */
    public function listURL(
        $alternativeId = '',
        $table = '-1',
        $excludeList = '')
    {
        $urlParameters = [];
        $urlParameters['id'] = (string)$alternativeId !== '' ? $alternativeId : $this->id;
        $urlParameters['table'] = $table === '-1' ? $this->table : $table;
        if ($this->returnUrl) {
            $urlParameters['returnUrl'] = $this->returnUrl;
        }
        if ((!$excludeList || !GeneralUtility::inList($excludeList, 'search_field')) && $this->searchString) {
            $urlParameters['search_field'] = $this->searchString;
        }
        if ($this->searchLevels) {
            $urlParameters['search_levels'] = $this->searchLevels;
        }
        if ($this->showLimit) {
            $urlParameters['showLimit'] = $this->showLimit;
        }
        if ((!$excludeList || !GeneralUtility::inList($excludeList, 'pointer')) && $this->page) {
            $urlParameters['pointer'] = $this->page;
        }
        if ((!$excludeList || !GeneralUtility::inList($excludeList, 'sortField')) && $this->sortField) {
            $urlParameters['sortField'] = $this->sortField;
        }
        if ((!$excludeList || !GeneralUtility::inList($excludeList, 'sortRev')) && $this->sortRev) {
            $urlParameters['sortRev'] = $this->sortRev;
        }
        $set = $this->request->getQueryParams()['SET'] ?? $this->request->getParsedBody()['SET'] ?? false;
        if ($set) {
            $urlParameters['SET'] = $set;
        }
        $show = $this->request->getQueryParams()['show'] ?? $this->request->getParsedBody()['show'] ?? 0;
        if ($show) {
            $urlParameters['show'] = (int)$show;
        }
        /** @var UriBuilder $uriBuilder */
        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        return (string)$uriBuilder->buildUriFromRoute('user_task', $urlParameters);
    }
}
