<?php

declare(strict_types=1);

namespace Snowbaha\SyliusDeliverySlipPlugin\Manager;

use Gaufrette\FilesystemInterface;
use Sylius\InvoicingPlugin\Manager\InvoiceFileManagerInterface;
use Sylius\InvoicingPlugin\Model\InvoicePdf;

final class DeliverySlipFileManager implements InvoiceFileManagerInterface
{
    /** @var FilesystemInterface */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function save(InvoicePdf $file): void
    {
        $this->filesystem->write($file->filename(), $file->content());
    }

    public function remove(InvoicePdf $file): void
    {
        $this->filesystem->delete($file->filename());
    }
}
