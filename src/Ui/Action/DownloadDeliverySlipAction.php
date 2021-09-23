<?php

declare(strict_types=1);

namespace Snowbaha\SyliusDeliverySlipPlugin\Ui\Action;

use Sylius\InvoicingPlugin\Doctrine\ORM\InvoiceRepositoryInterface;
use Sylius\InvoicingPlugin\Entity\InvoiceInterface;
use Sylius\InvoicingPlugin\Provider\InvoiceFileProviderInterface;
use Sylius\InvoicingPlugin\Security\Voter\InvoiceVoter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Webmozart\Assert\Assert;

final class DownloadDeliverySlipAction
{
    /** @var InvoiceRepositoryInterface */
    private $invoiceRepository;

    /** @var AuthorizationCheckerInterface */
    private $authorizationChecker;

    /** @var InvoiceFileProviderInterface */
    private $deliverySlipFilePathProvider;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        InvoiceFileProviderInterface $deliverySlipFilePathProvider
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->deliverySlipFilePathProvider = $deliverySlipFilePathProvider;
    }

    public function __invoke(string $id): Response
    {
        /** @var InvoiceInterface|null $invoice */
        $invoice = $this->invoiceRepository->find($id);
        Assert::notNull($invoice);

        if (!$this->authorizationChecker->isGranted(InvoiceVoter::ACCESS, $invoice)) {
            throw new AccessDeniedHttpException();
        }

        $invoiceFile = $this->deliverySlipFilePathProvider->provide($invoice);

        $response = new Response($invoiceFile->content(), Response::HTTP_OK, ['Content-Type' => 'application/pdf']);
        $response->headers->add([
            'Content-Disposition' => $response->headers->makeDisposition('attachment', $invoiceFile->filename()),
        ]);

        return $response;
    }
}
