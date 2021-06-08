<?php

namespace DPWebSolutions\LaravelFlash\Tests;

class FlashViewMessageTest extends TestCase
{
    /** @test */
    public function view_has_message_using_short_helper()
    {
        flash('Saved');

        $this->assertStringContainsString(
            'Saved',
            view('flash::messages', ['notification' => session('flash_notifications')[0]])->render()
        );
    }

    /**
     * @test
     *
     * @dataProvider notificationTypes
     */
    public function view_has_message_for_each_notification_type($type)
    {
        flash()->$type('A simple message');

        $this->assertStringContainsString(
            'A simple message',
            view('flash::messages', ['notification' => session('flash_notifications')[0]])->render()
        );
    }

    /**
     * @test
     *
     * @dataProvider notificationTypes
     */
    public function view_has_default_message_for_each_notification_type($type)
    {
        flash()->$type();

        $this->assertStringContainsString(
            config("flash.messages.{$type}"),
            view('flash::messages', ['notification' => session('flash_notifications')[0]])->render()
        );
    }
}
