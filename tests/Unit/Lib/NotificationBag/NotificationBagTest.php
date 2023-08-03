<?php

namespace App\Tests\Unit\Lib\NotificationBag;

use App\Lib\NotificationBag\Notification;
use App\Lib\NotificationBag\NotificationBag;
use Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class NotificationBagTest extends TestCase
{

    public function testToExceptionTraceWithClassName()
    {
        $bag = new NotificationBag();

        $bag->add(new Notification('1'));
        $bag->add(new Notification('2'));

        $result = $bag->toExceptionTrace(Exception::class);

        $this->assertCount(2, $result);

        $this->assertEquals([new Exception('1'), new Exception('2')], $result);
    }

    public function testToExceptionTraceWithCallable()
    {
        $bag = new NotificationBag();

        $bag->add(new Notification('1'));
        $bag->add(new Notification('2'));

        $result = $bag->toExceptionTrace(function (Notification $error) {

            if ($error->getMessage() === '1') {
                return new Exception();
            } else {
                return new RuntimeException();
            }

        });

        $this->assertCount(2, $result);

        $this->assertEquals([new Exception(), new RuntimeException()], $result);
    }
}
