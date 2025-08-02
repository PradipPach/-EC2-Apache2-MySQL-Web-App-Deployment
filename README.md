# -EC2-Apache2-MySQL-Web-App-Deployment
 Step 1: Set Up an EC2 Instance
1.Log in to AWS Console

Go to the AWS Management Console.
Navigate to the EC2 service.
2.Launch an EC2 Instance

Click Launch Instance.
Choose an Amazon Machine Image (AMI), such as Ubuntu.
Select an instance type (e.g., t2.micro for free tier).
Configure instance details (default settings are fine).
Add storage (default 8GB is sufficient).
Add tags (optional).
Configure the security group:
Allow HTTP (80), HTTPS (443), SSH (22), and MySQL (3306).
Review and launch the instance.
Create and download a key pair (webserver.pem) for SSH access.
3.Connect to the EC2 Instance

cd Downloads
chmod 400 webserver.pem
ssh -i "webserver.pem" ubuntu@<your-ec2-public-ip>
Step 2: Install Apache2, PHP, and MySQL
1.Update the System

sudo apt update && sudo apt upgrade -y
sudo -i passwd
2.Install PHP

sudo apt install php libapache2-mod-php php-mysql -y
3.Install Apache2

sudo apt install apache2 -y
4.Install MySQL

sudo apt install mysql-server -y
mysql --version
5.Start and Enable Services

sudo systemctl start apache2
sudo systemctl enable apache2
sudo systemctl status apache2

sudo systemctl start mysql
sudo systemctl enable mysql
sudo systemctl status mysql
6.Secure MySQL Installation

sudo mysql_secure_installation
7.Verify Apache Installation

Open browser: http://<your-ec2-public-ip>
You should see Apache's default landing page.

#Step 3: Set Up MySQL Database
1.Log in to MySQL

sudo mysql -u root -p
Create a Database and User

2.CREATE DATABASE myproject;
CREATE USER 'myuser'@'localhost' IDENTIFIED BY 'mypassword';
GRANT ALL PRIVILEGES ON myproject.* TO 'myuser'@'localhost';
FLUSH PRIVILEGES;
3.Create a Table

USE myproject;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);
EXIT;
Step 4: Deploy a PHP Web Application
1.Create Project Directory

sudo mkdir /var/www/html/myproject
sudo chown -R $USER:$USER /var/www/html/myproject
sudo chmod 755 /var/www/html/
cd /var/www/html
sudo rm index.html
sudo touch index.php
sudo nano index.php
Add PHP Code


2.Restart Apache

sudo systemctl restart apache2
