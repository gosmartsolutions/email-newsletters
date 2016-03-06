#Send transactional emails & email newsletters leveraging both the SendGrid and Mailgun API's

This is a simple program that allows you to easily send emails using both the Mailgun and SendGrid API's. No need to setup your own email servers. You can choose to use both API's by rotating email sending between the two or you can simply choose to use one or the other. The benefit is you are not locked into only 1 provider and can leverage both if wanted. We may add additional email API services in the future. Star or Watch this to keep updated.

#Installation
You need PHP 5+, MySQL and Composer installed on your server. You also need PDO enabled on the server.

1. Import the sql/email-newsletter-tables.sql file into your MySQL database.
2. Change the applications/Config.php file with your database settings, sendgrid & mailgun api keys and other settings.
3. Upload all files to the web directory on your domain where you want this to reside.
4. Navigate to the web url where it is installed and read through further detailed instructions on the index landing page.

#Email Templates 
Add email templates to a table, set a schedule date, from name, from email and more. Supports both HTML & plain text emails.

#Open & Link Click Tracking
Email open tracking and link tracking are built right in. Opens and link click data is saved in a table.

#Starter tables provided
An sql file is provided with the tables that are used in this example. Import the sql file into a new database to get started quickly. Or modify the code to fit your existing tables. All code that inserts/updates database tables is located in the applications directory. Database connection uses PDO.

#Modify Config.php file
Modify the applications/Config.php with your settings. NOTE: You need to have composer installed on your server. We included the needed composer.json and lock files along with all packages needed within the vendor directory. You should be able to upload everything as is to your domain or a sub directory on your domain and it should work as long as composer is installed.

#NO GUARANTEES
This is a side project we put together to help those who need an email sending program. There may be bugs that we don't know about. If you find any, please let us know. Keep in mind however that we can't guarantee we will make custom changes or additions for free. The software is provided as is. Feel free to add your own contributions and open a pull request or read below if you want to hire us for customizations.

#Want to hire us for customizations?
Would you like help installing this on your server or do you need help with customizations? Contact Us at http://www.gosmartsolutions.com/#contact and we'll provide you with a quote based on your requirements.
