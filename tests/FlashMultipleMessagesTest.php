<?php

namespace DPWebSolutions\LaravelFlash\Tests;

class FlashMultipleMessagesTest extends TestCase
{
    /**
     * @test
     */
    public function it_flash_more_than_one_message()
    {
        $this->assertCount(0, session("flash_notifications") ?? []);
        flash();
        $this->assertCount(1, session("flash_notifications"));
        flash();
        $this->assertCount(2, session("flash_notifications"));
        flash();
        $this->assertCount(3, session("flash_notifications"));
    }
}