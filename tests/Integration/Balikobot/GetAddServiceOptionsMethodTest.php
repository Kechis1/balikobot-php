<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_array;
use function is_int;
use function is_string;

class GetAddServiceOptionsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP);

        self::assertTrue(count($options) > 0);
        foreach ($options as $serviceType => $serviceOptions) {
            self::assertTrue(is_string($serviceType));
            self::assertTrue(is_array($serviceOptions));
            if (is_array($serviceOptions)) {
                foreach ($serviceOptions as $code => $option) {
                    self::assertTrue(is_int($code) || is_string($code));
                    self::assertTrue(is_string($option));
                }
            }
        }
    }

    public function testValidRequestWithService(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, ServiceType::CP_CE);

        self::assertTrue(count($options) > 0);
        foreach ($options as $code => $option) {
            self::assertTrue(is_int($code));
            self::assertTrue(is_string($option));
        }
    }

    public function testValidRequestWithFullData(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, fullData: true);

        self::assertTrue(count($options) > 0);
        foreach ($options as $serviceType => $serviceOptions) {
            self::assertTrue(is_string($serviceType));
            self::assertTrue(is_array($serviceOptions));
            if (is_array($serviceOptions)) {
                foreach ($serviceOptions as $code => $option) {
                    self::assertTrue(is_array($option));
                    self::assertTrue(is_array($option) && is_string($option['name']));
                    self::assertTrue(is_array($option) && $option['code'] === (string) $code);
                }
            }
        }
    }

    public function testValidRequestWithServiceWithFullData(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, ServiceType::CP_CE, fullData: true);

        self::assertTrue(count($options) > 0);
        foreach ($options as $code => $option) {
            self::assertTrue(is_array($option));
            self::assertTrue(is_array($option) && is_string($option['name']));
            self::assertTrue(is_array($option) && $option['code'] === (string) $code);
        }
    }
}
