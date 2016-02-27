<?php

//Timezone
date_default_timezone_set('UTC');

//SET DEFAULTS IF NOTHING IS PASSED IN QUERYSTRING
define('DEFAULT_SERVER', 'mailgun');
define('DEFAULT_SEND_LIMIT', 50);

//WEBSITE SETTINGS
define('WEBSITE_NAME', "Your Website Name");
define('WEBSITE_DOMAIN', "http://www.yourwebsite.com");
define('DOMAIN_NAME', "yourwebsite.com");

//It should be the same as domain (if script is placed on website's root folder) 
//or it can contain path that include subfolders if script is located in a subfolder and not in root folder
define('SCRIPT_URL', "http://www.yourwebsite.com/subfolder/");

//DATABASE CONFIGURATION
define('DB_HOST', 'yourdbhost'); 
define('DB_TYPE', 'mysql');
define('DB_USER', 'dbuser');
define('DB_PASS', 'dbpass');
define('DB_NAME', 'dbname');

//ADMIN EMAIL AND OTHER STUFF
define('ADMIN_EMAIL', 'admin@youremail.com');
define('ADMIN_EMAIL_NAME', 'Admin Name');

//API Keys
define('MAILGUN_KEY', 'place-mailgin-key-here');
define('SENDGRID_KEY', 'place-sendgrid-key-here');
