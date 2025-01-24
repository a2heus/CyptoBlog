# CryptoBlog

Welcome to CryptoBlog! Follow the steps below to set up and run the project.

## 🚀 Getting Started

1. **Clone the Repository**  
   Clone the repository to your local machine:  
   ```bash
   git clone <repository_url>
   cd <repository_name>
   ```

2. **Configure Your Database**  
   Edit the `Config.php` file to add your SQL server credentials:
   ```php
   $db_host = 'your_host';
   $db_user = 'your_username';
   $db_pass = 'your_password';
   $db_name = 'your_database_name';
   ```

3. **Import the SQL Template**  
   A prebuilt SQL template (`Articles.sql`) is provided for you to quickly set up the database. Import it into your database using phpMyAdmin or any MySQL manager of your choice.

## 🌐 Demo  

A live demo is available here:  
[CryptoBlog Demo](https://cryptoblog.ct.ws/)
> I got a SSL certificate for the demo !

## 🔑 Admin Credentials  

Default credentials for `admin.php` are as follows:  
- **Username:** `root`  
- **Password:** `root`

> ⚠️ **Important:** For security reasons, make sure to change these credentials in production.

## 🛠 Requirements

- PHP 7.4 or higher  
- MySQL 5.7 or higher  
- Apache or any compatible web server  

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
