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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Registry;
/**
 * Class PageLayoutController
 *
 * @package \\${NAMESPACE}
 */
class PageLayoutController extends Typo3PageLayoutController{



    /**
     * We override this function to implement new solution now we use sys_register to can manipulate the value of page language
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return void
     */
    protected function menuConfig(ServerRequestInterface $request): void{

        //Call to the parent function
        parent::menuConfig($request);

        $registry = GeneralUtility::makeInstance(Registry::class);

        if(!is_null($request->getQueryParams()['SET']) && isset($request->getQueryParams()['SET']['language'])){
            $registry->set('core','page_be_lang',$request->getQueryParams()['SET']['language']);
        }

        if(count($this->MOD_MENU['language']) > 1){
            $this->MOD_SETTINGS['language'] = $registry->get('core','page_be_lang');
        }else{
            $this->MOD_SETTINGS['language'] = key($this->MOD_MENU['language']);
        }

    }
}