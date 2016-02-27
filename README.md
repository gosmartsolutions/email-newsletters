#Welcome to a Mandrill alternative that leverages both SendGrid and Mailgun API's

With the recent announcement about Mandrill, we wanted to provide a way to leverage other email API's. This is a simple program that allows you to easily send emails using both Mailgun and SendGrid. You can choose to use both API's by rotating email sending between the two or you can simply choose to use one or the other. The benefit is you are not locked into only 1 provider and can leverage both if wanted. We may add additional email API services in the future.

#Installation
Please read the index.html file for details on how to install and run this program.

#Email Templates 
Add email templates to a table, set a schedule date, from name, from email and more. Supports both HTML & plain text emails.

#Open & Link Click Tracking
Email open tracking and link tracking are built right in. Opens and link click data is saved in a table.
Starter tables provided

#Starter tables provided
An sql file is provided with the tables that are used in this example. Import the sql file into a new database to get started quickly. Or modify the code to fit your existing tables. All code that inserts/updates database tables is located in the applications directory. Database connection uses PDO.

#Modify Config.php file
Modify the applications/Config.php with your settings. NOTE: You need to have composer installed on your server. We included the needed composer.json and lock files along with all packages needed within the vendor directory. You should be able to upload everything as is to your domain or a sub directory on your domain and it should work as long as composer is installed.
NO GUARANTEES ON QUALITY OR THAT IT WILL WORK FOR YOU

#NO GUARANTEES
This is a quick side project we put together to help those who need to migrate away from Mandrill. There may be bugs that we don't know about and that may break things. If you find any, please let us know. Keep in mind however that we can't guarantee we will make custom changes or additions for free. The software is provided as is. Feel free to add your own contributions and open a pull request or read below if you want to hire us for customizations.

#Want to hire us for customization?
Would you like help installing this on your server or do you need help with customization? Contact Us at http://www.gosmartsolutions.com/#contact and we'll provide you with a quote based on your requirements.
