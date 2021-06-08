<?php

namespace DPWebSolutions\LaravelFlash\Tests;

use DPWebSolutions\LaravelFlash\LaravelFlashServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelFlashServiceProvider::class];
    }

    public function notificationTypes(): array
    {
        return [
            ['success'],
            ['error'],
            ['warning'],
            ['stored'],
            ['updated'],
            ['deleted'],
            ['queued'],
        ];
    }
}
