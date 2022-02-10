<?php

namespace DPWebSolutions\LaravelFlash\Tests;

/**
 * @internal
 * @coversNothing
 */
class FlashDismissibleTest extends TestCase
{
    /** @test */
    public function it_flash_a_message_as_dismissible()
    {
        flash()->error('Exception')->dismissible(true);

        $index = count(session('flash_notifications')) - 1;

        $this->assertTrue(session("flash_notifications.{$index}.dismissible"));
    }

    /** @test */
    public function it_flash_a_message_as_not_dismissible()
    {
        flash('Good job')->dismissible(false);

        $index = count(session('flash_notifications')) - 1;

        $this->assertFalse(session("flash_notifications.{$index}.dismissible"));
    }
}
