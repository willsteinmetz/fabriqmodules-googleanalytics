# Fabriq Modules - Google Analytics

___This project is no longer maintained or updated and is archived. Should you choose to fork it, please maintain the proper license and credits.___

This module for the Fabriq framework provides functionality for adding the code for Google Analytics to your Fabriq website or web application. Note: you will need a Google Analytics API key for this module.

After configuring the module, add the following lines of code just before the closing </body> tag in each template file in your site:

<?php
FabriqModules::module('googleanalytics')->js();
echo FabriqModules::render_now('googleanalytics', 'js');
?>
