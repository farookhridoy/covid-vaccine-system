<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Vaccination Registration System
## Specification
As per given task docs I analyze and try to ensure that, this Vaccination Registration system built using Laravel. Users can register for vaccination at various vaccine centers. The system ensures that:
- Users cannot register twice.
- Vaccination schedules are distributed based on the "first come first serve" strategy, only on weekdays (Sunday to Thursday).
- Users can search for their vaccination status using their NID.
- Email notifications are sent the night before the scheduled vaccination date.

## Features
- Register for vaccination at different centers.
- Vaccine centers have daily capacity limits.
- Vaccination is scheduled only on weekdays.
- Users can view their vaccination status: Not Registered, Not Scheduled, Scheduled, or Vaccinated.
- Scheduled email reminders for users who have a vaccination appointment the next day.

## Requirements
- PHP >= 8.0
- Composer
- MySQL or any compatible relational database
- Laravel 10

## Installation

1. **Clone the repository**:

    ```bash
    git clone https://github.com/farookhridoy/covid-vaccine-system.git
    cd covid-vaccine-system
    ```

2. **Install dependencies**:

   Run the following command to install PHP dependencies using Composer:

    ```bash
    composer install or composer update
    ```

3. **Create a `.env` file**:

   Copy the example `.env` file to create your configuration file:

    ```bash
    cp .env.example .env
    ```

4. **Configure the `.env` file**:

   Open the `.env` file and set the appropriate values for your database and mail server settings.

   Example database configuration:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=covid_vaccine_db
    DB_USERNAME=root
    DB_PASSWORD=your_password
    ```

   Example mail configuration:
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=no-reply@example.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```

5. **Generate application key**:

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations**:

    ```bash
    php artisan migrate
    ```

7. **Generate Dummy vaccine centers**:
    
    Run this command for some factory data 
    ```bash
    php artisan db:seed
    ```

## Running the Application

1. **Run the application**:

   You can use Laravel's built-in server to run the application locally:

    ```bash
    php artisan serve
    ```

2. **Visit the application**:

   Open your browser and navigate to `http://127.0.0.1:8000/` to view the application.

## Scheduling Email Notifications & User Vaccinate Status Update

Command has been set up on laravel karnel To ensure email reminders are sent the night before a user's scheduled vaccination.

1. **Run the scheduler for testing if its works or not**:

   For testing purpose before run this `php artisan schedule:run` command, go to `app\Console\Kernel.php` and edit `40th` no line `->dailyAt('21:00'); replace to ->everyMinute()` and save. After test, you can rollback code `->dailyAt('21:00');`

   Open `bash` and run this command:

    ```bash
      php artisan schedule:run
    ```
   Now check the database and your email to find a notification email sent from the system.

## How to Handle Future SMS Notifications

If SMS notifications are required in the future, you will need to make the following changes: 

1. **Migrate phone number**:

    In this users table we do not add the `phone` number column. So, you need to add this column on users table by run migration.
    ```bash
   php artisan make:migration add_phone_column_in_users_table --table='users'
   ```
   
  ```php
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
   ```
2. **Install an SMS service package**:
    You can add twilio or another sms service you want to send sms notification.
   For example, to use Twilio:
   ```bash
   composer require twilio/sdk

3. **Add SMS Logic**:
    In `VaccineScheduleNotification` class or make new notification class and add this method as per documents provide here `https://github.com/twilio/twilio-php`

