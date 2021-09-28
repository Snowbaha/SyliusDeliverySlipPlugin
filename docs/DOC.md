# DOCUMENTATION

## add the download button in order admin details

![](img/order_invoice_button_bottom.png)

````twig
# templates/bundles/SyliusInvoicingPlugin/Order/Admin/_invoices.html.twig
{% include '@SnowbahaSyliusDeliverySlipPlugin/SyliusInvoicingPlugin/Order/Admin/_invoices.html.twig' %}
````

## custom translations and  PDF template

you can ovveride the PDF file : [pdf.html.twig](../src/Resources/views/DeliverySlip/Download/pdf.html.twig)
