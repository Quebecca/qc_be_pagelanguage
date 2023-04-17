<?php

declare(strict_types=1);
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

namespace Qc\QcBePageLanguage\Controller;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Controller\PageLayoutController as Typo3PageLayoutController;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use Qc\QcBePageLanguage\Domain\Repository\BackendUserRepository;
/**
 * Class PageLayoutController
 *
 * @package Qc\QcBePageLanguage
 */
class PageLayoutController extends Typo3PageLayoutController{

    /**
     * @var BackendUserRepository
     */
    protected $backendUserRepository;


    /**
     *  We override this function to implement new solution now we use sys_register to can manipulate the value of page language
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return void
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
    protected function menuConfig(ServerRequestInterface $request): void{

        //Call to the parent function
        parent::menuConfig($request);

        $canUseBeUserPageLanguage = (int)BackendUtility::getPagesTSconfig($this->id)['mod.']['tx_qc_be_pagelanguage.']['use_be_user_page_language'];

        if($canUseBeUserPageLanguage){
            $context = GeneralUtility::makeInstance(Context::class);
            $this->backendUserRepository = GeneralUtility::makeInstance(BackendUserRepository::class);

            $backendUserId = $context->getPropertyFromAspect('backend.user', 'id');

            if(!is_null($request->getQueryParams()['SET']) && isset($request->getQueryParams()['SET']['language'])){
                $this->backendUserRepository->updateBackendUserPageLanguage($backendUserId, $request->getQueryParams()['SET']['language']);
            }

            if(count($this->MOD_MENU['language']) > 1){
                $pageLanguageUid = BackendUtility::getRecord('be_users', $backendUserId, 'page_mod_language', 'true')['page_mod_language'];
                $this->MOD_SETTINGS['language'] = $pageLanguageUid;
            }else{
                $this->MOD_SETTINGS['language'] = key($this->MOD_MENU['language']);
            }
        }
    }
}