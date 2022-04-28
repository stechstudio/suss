<?php

declare(strict_types=1);

namespace Sts\Tests\Service;

use Carbon\Carbon;
use DateTime;
use Sts\Suss\Service\Infer;
use PHPUnit\Framework\TestCase;


final class InferTest extends TestCase
{
    public function testValidationFailsOnBadFormats()
    {
        $formats = collect([
            'THis is not it',
            '202020 00222 0002',
            '',
        ]);

        $formats->each(function (string $format) {
            $this->assertFalse(Infer::isValid($format), "[$format] should not be a valid datetime.");
        });
    }

    public function testValidatesOnGoodFormats()
    {
        $carbon = new Carbon(new DateTime('now'));
        $formats = collect([
            $carbon->toAtomString(),
            $carbon->toCookieString(),
            $carbon->toDateString(),
            $carbon->toDateTimeLocalString(),
            $carbon->toDayDateTimeString(),
            $carbon->toFormattedDateString(),
            $carbon->toISOString(),
            $carbon->toIso8601String(),
            $carbon->toIso8601ZuluString(),
            $carbon->toRfc1036String(),
            $carbon->toRfc1123String(),
            $carbon->toRfc2822String(),
            $carbon->toRfc3339String(),
            $carbon->toRfc7231String(),
            $carbon->toRfc822String(),
            $carbon->toRfc850String(),
            $carbon->toRssString(),
            $carbon->toString(),
            $carbon->toTimeString()
        ]);

        $formats->each(function (string $format) {
            $this->assertTrue(Infer::isValid($format), "[$format] should be a valid datetime.");
        });
    }
}
