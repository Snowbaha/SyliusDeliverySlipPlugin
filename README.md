# Delivery Note Plugin

[![Latest Stable Version](http://poser.pugx.org/snowbaha/sylius-delivery-slip-plugin/v)](https://packagist.org/packages/snowbaha/sylius-delivery-slip-plugin) [![Total Downloads](http://poser.pugx.org/snowbaha/sylius-delivery-slip-plugin/downloads)](https://packagist.org/packages/snowbaha/sylius-delivery-slip-plugin) [![Latest Unstable Version](http://poser.pugx.org/snowbaha/sylius-delivery-slip-plugin/v/unstable)](https://packagist.org/packages/snowbaha/sylius-delivery-slip-plugin) 

Add a delivery slip download (PDF) with the Sylius invoice plugin.

### Installation

1. Be sure to have [Sylius Invoice Plugin](https://github.com/Sylius/InvoicingPlugin) installed

3. Require plugin with composer:

    ```bash
    composer require snowbaha/sylius-delivery-slip-plugin
    ```

4. Add plugin class to your `bundles`:

    ```php
    $bundles = [
        Snowbaha\SyliusDeliverySlipPlugin\SnowbahaSyliusDeliverySlipPlugin::class => ['all' => true],
    ];
    ```

5. Import configuration:

    ```yaml
    imports:
        - { resource: "@SnowbahaSyliusDeliverySlipPlugin/Resources/config/config.yml" }
    ```

6. Import routing:

    ```yaml
    snowbaha_sylius_delivery_slip_plugin_admin:
        resource: "@SnowbahaSyliusDeliverySlipPlugin/Resources/config/app/routing/admin.yml"
        prefix: /%sylius_admin.path_name%
    ```

7. Clear cache:

    ```bash
    php bin/console cache:clear
    ```

8. custom translations and  PDF template
    See more at [the documentation](docs/DOC.md)
