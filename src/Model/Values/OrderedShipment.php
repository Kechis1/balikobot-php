<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

class OrderedShipment
{
    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string
     */
    private string $handoverUrl;

    /**
     * @var string
     */
    private string $labelsUrl;

    /**
     * @var string|null
     */
    private ?string $fileUrl;

    /**
     * @var string
     */
    private string $shipper;

    /**
     * @var array<string>
     */
    private array $packageIds;

    /**
     * OrderedShipment constructor
     *
     * @param string        $orderId
     * @param string        $shipper
     * @param array<string> $packageIds
     * @param string        $handoverUrl
     * @param string        $labelsUrl
     * @param string|null   $fileUrl
     */
    public function __construct(
        string $orderId,
        string $shipper,
        array $packageIds,
        string $handoverUrl,
        string $labelsUrl,
        ?string $fileUrl = null
    ) {
        $this->orderId     = $orderId;
        $this->shipper     = $shipper;
        $this->packageIds  = $packageIds;
        $this->handoverUrl = $handoverUrl;
        $this->labelsUrl   = $labelsUrl;
        $this->fileUrl     = $fileUrl;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getHandoverUrl(): string
    {
        return $this->handoverUrl;
    }

    /**
     * @return string
     */
    public function getLabelsUrl(): string
    {
        return $this->labelsUrl;
    }

    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * Get package IDs
     *
     * @return array<string>
     */
    public function getPackageIds(): array
    {
        return $this->packageIds;
    }

    /**
     * @param string              $shipper
     * @param array<string>       $packageIds
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     */
    public static function newInstanceFromData(string $shipper, array $packageIds, array $data): self
    {
        return new self(
            $data['order_id'],
            $shipper,
            $packageIds,
            $data['handover_url'],
            $data['labels_url'],
            $data['file_url'] ?? null
        );
    }
}
