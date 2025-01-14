<?php

namespace DPWebSolutions\LaravelFlash\Tests;

/**
 * @internal
 * @coversNothing
 */
class FlashViewClassTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider notificationTypes
     *
     * @param mixed $type
     */
    public function view_has_message_for_each_tailwind_notification_type($type)
    {
        flash()->{$type}();

        $this->assertStringContainsString(
            config("flash.classes.tailwind.{$type}"),
            view('flash::messages', ['notification' => session('flash_notifications')[0]])->render()
        );
    }

    /**
     * @test
     *
     * @dataProvider notificationTypes
     *
     * @param mixed $type
     */
    public function view_has_message_for_each_bootstrap_notification_type($type)
    {
        config(['flash.framework' => 'bootstrap']);

        flash()->{$type}();

        $this->assertStringContainsString(
            config("flash.classes.bootstrap.{$type}"),
            view('flash::messages', ['notification' => session('flash_notifications')[0]])->render()
        );
    }
}
