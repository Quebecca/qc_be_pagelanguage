<?php
/***
 *
 * This file is part of Qc BE domaine color project.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2022 <techno@quebec.ca>
 *
 ***/
namespace Qc\QcBePageLanguage\Controller;
use Doctrine\DBAL\DBALException;
use Psr\Http\Message\ServerRequestInterface;
use Sypets\PageCallouts\Xclass\PageLayoutControllerWithCallouts;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use Qc\QcBePageLanguage\Domain\Repository\BackendUserRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageCalloutsXclass extends PageLayoutControllerWithCallouts
{
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
     * @throws DBALException
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

            if(count($this->MOD_MENU['language']) > 1){
                $pageLanguageUid = BackendUtility::getRecord('be_users', $backendUserId, 'page_mod_language', 'true')['page_mod_language'];
                $this->MOD_SETTINGS['language'] = array_key_exists($pageLanguageUid, $this->MOD_MENU['language'])
                    ? $pageLanguageUid
                    : $this->MOD_SETTINGS['language'];
            }else{
                $this->MOD_SETTINGS['language'] = key($this->MOD_MENU['language']);
            }
        }
    }

}
