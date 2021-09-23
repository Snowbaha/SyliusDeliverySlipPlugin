# Delivery Note Plugin (WIP)

Add a delivery slip download with the Sylius invoice plugin.


### Legacy installation

1. Be sure to have Sylius Invoice Plugin installed

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
    bin/console cache:clear
    ```
