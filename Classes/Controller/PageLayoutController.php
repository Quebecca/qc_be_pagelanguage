<?php

declare(strict_types=1);
/***
 *
 * This file is part of Qc BE Page Language project.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2022 <techno@quebec.ca>
 *
 ***/

namespace Qc\QcBePageLanguage\Controller;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Controller\PageLayoutController as Typo3PageLayoutController;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use Qc\QcBePageLanguage\Domain\Repository\BackendUserRepository;
/**
 * Class PageLayoutController
 *
 * @package Qc\QcBePageLanguage
 */
class PageLayoutController extends Typo3PageLayoutController {

    /**
     * @var BackendUserRepository
     */
    protected BackendUserRepository $backendUserRepository;


    /**
     *  We override this function to implement new solution, now we use be_users to manipulate the value of page language
     * @param ServerRequestInterface $request
     *
     * @return void
     * @throws AspectNotFoundException
     */
    protected function menuConfig(ServerRequestInterface $request): void {

        //Call to the parent function
        parent::menuConfig($request);

        $canUseBeUserPageLanguage = (int)BackendUtility::getPagesTSconfig($this->id)['mod.']['tx_qc_be_pagelanguage.']['use_be_user_page_language'];

        if($canUseBeUserPageLanguage){
            $context = GeneralUtility::makeInstance(Context::class);
            $this->backendUserRepository = GeneralUtility::makeInstance(BackendUserRepository::class);

            $backendUserId = $context->getPropertyFromAspect('backend.user', 'id');


            $queryParams = $request->getQueryParams();
            if(isset($queryParams['SET']['language'])){
                $this->backendUserRepository->updateBackendUserPageLanguage($backendUserId, $queryParams['SET']['language']);
            } 
 
            if((is_countable($this->MOD_MENU['language']) ? count($this->MOD_MENU['language']) : 0) > 1){
                $pageLanguageUid = BackendUtility::getRecord('be_users', $backendUserId, 'page_mod_language', 'true')['page_mod_language'];
                $languageKey = array_key_exists($pageLanguageUid, $this->MOD_MENU['language'])
                    ? $pageLanguageUid
                    : (int)$this->moduleData->get('language');

                $this->moduleData->set('language', $languageKey);
            }else{
                $this->moduleData->set('language', key($this->MOD_MENU['language']));
            }
        }
    }
}
