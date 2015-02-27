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
 * @copyright  Copyright (c) 2010, Daniel Deady
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Clockworkgeek_Rememberme_Model_Cookie extends Mage_Core_Model_Cookie
{

    /**
     * Set cookie
     * Override period if asked to
     *
     * @param string $name The cookie name
     * @param string $value The cookie value
     * @param int $period Lifetime period
     * @param string $path            
     * @param string $domain            
     * @param int|bool $secure            
     * @return Mage_Core_Model_Cookie
     */
    public function set($name, $value, $period = null, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        if (is_null($period)) {
            // use $_SESSION directly as session classes may not be initialised yet
            $session = (bool) @$_SESSION['rememberme'];
            $login = Mage::app()->getRequest()->getPost('login');
            $rememberme = (bool) @$login['rememberme'];
            if ($session || $rememberme)
                $period = true; // true = one year
        }
        return parent::set($name, $value, $period, $path, $domain, $secure, $httponly);
    }
}
