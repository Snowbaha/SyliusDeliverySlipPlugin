<?php

declare(strict_types=1);

namespace Snowbaha\SyliusDeliverySlipPlugin\Provider;

use Gaufrette\Exception\FileNotFound;
use Gaufrette\FilesystemInterface;
use Sylius\InvoicingPlugin\Entity\InvoiceInterface;
use Sylius\InvoicingPlugin\Generator\InvoiceFileNameGeneratorInterface;
use Sylius\InvoicingPlugin\Generator\InvoicePdfFileGeneratorInterface;
use Sylius\InvoicingPlugin\Manager\InvoiceFileManagerInterface;
use Sylius\InvoicingPlugin\Model\InvoicePdf;
use Sylius\InvoicingPlugin\Provider\InvoiceFileProviderInterface;

final class DeliverySlipFileProvider implements InvoiceFileProviderInterface
{
    /** @var InvoiceFileNameGeneratorInterface */
    private $invoiceFileNameGenerator;

    /** @var FilesystemInterface */
    private $filesystem;

    /** @var InvoicePdfFileGeneratorInterface */
    private $invoicePdfFileGenerator;

    /** @var InvoiceFileManagerInterface */
    private $invoiceFileManager;

    /** @var string */
    private $invoicesDirectory;

    public function __construct(
        InvoiceFileNameGeneratorInterface $invoiceFileNameGenerator,
        FilesystemInterface $filesystem,
        InvoicePdfFileGeneratorInterface $invoicePdfFileGenerator,
        InvoiceFileManagerInterface $invoiceFileManager,
        string $invoicesDirectory
    ) {
        $this->invoiceFileNameGenerator = $invoiceFileNameGenerator;
        $this->filesystem = $filesystem;
        $this->invoicePdfFileGenerator = $invoicePdfFileGenerator;
        $this->invoiceFileManager = $invoiceFileManager;
        $this->invoicesDirectory = $invoicesDirectory;
    }

    public function provide(InvoiceInterface $invoice): InvoicePdf
    {
        $invoiceFileName = $this->invoiceFileNameGenerator->generateForPdf($invoice);

        try {
            $invoiceFile = $this->filesystem->get($invoiceFileName);
            $invoicePdf = new InvoicePdf($invoiceFileName, $invoiceFile->getContent());
        } catch (FileNotFound $exception) {
            $invoicePdf = $this->invoicePdfFileGenerator->generate($invoice);
            $this->invoiceFileManager->save($invoicePdf);
        }

        $invoicePdf->setFullPath($this->invoicesDirectory.'/'.$invoiceFileName);

        return $invoicePdf;
    }
}
