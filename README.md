#Welcome to a Mandrill alternative written in PHP

This is a simple program that allows you to easily send email newsletters using both Mailgun and SendGrid. You can choose to use both by switching email sending between the two or you can simply choose to use one or the other.
Email Templates

Add your email newsletter templates to a MySQL table, set a schedule date, from name, from email and more. Supports both HTML & plain text emails. We even give you a responsive email template to start with.
Open & Link Click Tracking

Email open tracking and link tracking are built right in. Opens and link click data is saved in a database.
Starter MySQL tables provided

An sql file is provided with the tables that are used in this program. Import the sql file into a new MySQL database to get started quickly. Or modify the code to fit your existing tables. All code that inserts/updates database tables is located in the applications directory. Database connection uses PDO.
Modify 1 Config.php file

Modify the applications/Config.php with your settings. NOTE: You need to have composer installed on your server. We included the needed composer.json and lock files along with all packages needed within the vendor directory. You should be able to upload everything as is to your domain or a sub directory on your domain and it should work as long as composer is installed.
NO GUARANTEES ON QUALITY OR THAT IT WILL WORK FOR YOU

THIS IS A QUICK SIDE PROJECT WE PUT TOGETHER THAT WE ARE HOPING HELPS SOME. There may be bugs that we don't know about and that may break things. If you find any, please let us know. Keep in mind however that we work full-time and cannot provide free support. Read below if you want support from us. Feel free to add your own contributions too that you feel others will benefit from and open a pull request.
Want to hire us for customization?

Would you like help installing this on your server or do you need help with customization? Contact Us at http://www.gosmartsolutions.com/#contact and we'll provide you with a quote based on your requirements.
