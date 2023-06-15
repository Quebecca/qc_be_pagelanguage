<?php

namespace Qc\QcBePageLanguage\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageLangHandler
{

    /**
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
    public function getSelectedLang(ServerRequestInterface $request): ResponseInterface{
        $context = GeneralUtility::makeInstance(Context::class);
        $backendUserId = $context->getPropertyFromAspect('backend.user', 'id');
        $pageLanguageUid = BackendUtility::getRecord('be_users', $backendUserId, 'page_mod_language', 'true')['page_mod_language'];

        //@todo : Il faut vérifier que la page courante a la langue stockée dans la bd


        return new JsonResponse(['language_uid' => $pageLanguageUid]);

    }


}