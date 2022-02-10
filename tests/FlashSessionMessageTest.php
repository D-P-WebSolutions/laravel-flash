<?php

namespace DPWebSolutions\LaravelFlash\Tests;

/**
 * @internal
 * @coversNothing
 */
class FlashSessionMessageTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider notificationTypes
     *
     * @param mixed $type
     */
    public function it_flash_a_message_for_each_notification_type($type)
    {
        $message = "This is a message of type {$type}";

        flash()->{$type}($message);

        $index = count(session('flash_notifications')) - 1;

        $this->assertEquals($message, session("flash_notifications.{$index}.message"));
    }

    /**
     * @test
     *
     * @dataProvider notificationTypes
     *
     * @param mixed $type
     */
    public function it_flash_a_key_for_each_notification_type($type)
    {
        $message = "This is a message of type {$type}";

        flash()->{$type}($message);

        $index = count(session('flash_notifications')) - 1;

        $this->assertEquals($type, session("flash_notifications.{$index}.type"));
    }
}
