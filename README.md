# Mage2 Module Bluethinkinc NotifyStockAvailability

    ``bluethinkinc/module-notifystockavailability``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
this extention for notify stock availability

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Bluethinkinc`
 - Enable the module by running `php bin/magento module:enable Bluethinkinc_NotifyStockAvailability`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require bluethinkinc/module-notifystockavailability`
 - enable the module by running `php bin/magento module:enable Bluethinkinc_NotifyStockAvailability`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

![Configuration Setting](docs/images/1-notifystockavailability-configuration.png)
![Configuration Setting](docs/images/2-notifystockavailability-configuration.png)
![Configuration Setting](docs/images/3-notifystockavailability-configuration.png)
- Select from configuration and Save Config.




