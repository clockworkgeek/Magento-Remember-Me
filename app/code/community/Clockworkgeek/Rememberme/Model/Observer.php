<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * @category   Customer
 * @package    Clockworkgeek_Rememberme
 * @author     Daniel Deady <daniel@clockworkgeek.com>
 * @copyright  Copyright (c) 2015, Daniel Deady
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Clockworkgeek_Rememberme_Model_Observer
{

    /**
     * Add our flag on login
     */
    public function setSessionRemembrance()
    {
        if (isset($_SESSION) && ! isset($_SESSION['rememberme'])) {
            $login = Mage::app()->getRequest()->getPost('login');
            $_SESSION['rememberme'] = (bool)@$login['rememberme'];
        }
    }

    /**
     * Remove our flag on logout
     */
    public function unsetSessionRemembrance()
    {
        if (isset($_SESSION['rememberme'])) {
            unset($_SESSION['rememberme']);
        }
    }

    /**
     * Session is saved last, after page is output and sent.
     * If saved in database then session has an individual expiry time.
     */
    public function setSessionExpiry()
    {
        if (isset($_SESSION['rememberme']) && $_SESSION['rememberme']) {
            /* @var $store Mage_Core_Model_Store */
            $store = Mage::app()->getStore();
            if (! $store->isAdmin()) {
                // session expiry is taken from cookie lifetime
                $store->setConfig('web/cookie/cookie_lifetime', 60 * 60 * 24 * 365);
            }
        }
    }
}
