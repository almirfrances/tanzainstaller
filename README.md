# TanzaInstaller

![Packagist Version](https://img.shields.io/packagist/v/almirfrances/tanzainstaller)
![PHP Version](https://img.shields.io/packagist/php-v/almirfrances/tanzainstaller)
![License](https://img.shields.io/github/license/almirfrances/tanzainstaller)
![Downloads](https://img.shields.io/packagist/dt/almirfrances/tanzainstaller)

TanzaInstaller is a Laravel package that provides a seamless multistep installation wizard for your Laravel applications. It ensures proper configuration of your application in a user-friendly manner.

## Features

- Multistep installation wizard
- Dynamic configuration updates
- Middleware to ensure installation is complete
- Easily customizable and extensible

## Installation

### Step 1: Install the package

Run the following command in your Laravel application:

```bash
composer require almirfrances/tanzainstaller --dev

```

### Step 2: Publish the package assets

Publish the package configuration and views using the command:

```bash
php artisan vendor:publish --provider="AlmirFrances\TanzaInstaller\TanzaInstallerServiceProvider"

```

### Step 3: Configure the .env

Ensure the following variables are in your .env file:

```bash
INSTALLER_INSTALLED=false
```

## Middleware

This package includes middleware to ensure that the application cannot be accessed until the installation is complete. The middleware automatically redirects to /install if the application is not installed.

### Example .env Configuration

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=http://localhost


DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

CACHE_STORE=file
CACHE_PREFIX=

INSTALLER_INSTALLED=false
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss improvements or bug fixes.
License

TanzaInstaller is open-sourced software licensed under the MIT license.
