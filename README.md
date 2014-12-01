Adds a "remember me" option to login forms.

If using a custom theme that modifies the login template please pay attention to `/app/design/frontend/base/default/template/rememberme/` directory. The templates in that directory override the base login forms and so custom changes need to be duplicated there.

This extension works by extending the lifetime of cookies, in all likelihood your server will also need to extend the lifetime of it's sessions. To do this add the following to the site's `.htaccess` file:

    php_value session.gc_maxlifetime 2592000

To install, get your extension key from [the Connect Marketplace](http://www.magentocommerce.com/magento-connect/remember-me.html) or composer users can enter this command:

    composer config repositories.firegento composer http://packages.firegento.com
    composer require clockworkgeek/rememberme
  
If you wish to edit this code then copy these files to an installed Magento directory, the package XML file is included so it will be available from _System > Magento Connect > Package Extensions > Load Local Package_.
You can then update and re-package as necessary.
