<?php

namespace RichanFongdasen\GCRWorker\Tests;

use Orchestra\Testbench\TestCase as BaseTest;

abstract class TestCase extends BaseTest
{
    /**
     * Application object.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $this->app = $app;

        $configs = json_decode(file_get_contents(
            dirname(__DIR__).'/dummies/config.json'
        ), true);

        foreach ($configs as $key => $value) {
            $app['config']->set($key, $value);
        }
    }

    /**
     * Define package aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        $this->app = $app;

        return [
            'Route' => \Illuminate\Support\Facades\Route::class,
        ];
    }

    /**
     * Define package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        $this->app = $app;

        return [
            \Illuminate\Cache\CacheServiceProvider::class,
            \Illuminate\Foundation\Support\Providers\RouteServiceProvider::class,
            \RichanFongdasen\GCRWorker\ServiceProvider::class,
        ];
    }

    /**
     * Invoke protected / private method of the given object.
     *
     * @param object $object
     * @param string $methodName
     * @param array  $parameters
     *
     * @throws \ReflectionException if the method does not exist.
     *
     * @return mixed
     */
    protected function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Get any protected / private property value.
     *
     * @param mixed  $object
     * @param string $propertyName
     *
     * @throws \ReflectionException If no property exists by that name.
     *
     * @return mixed
     */
    public function getPropertyValue($object, $propertyName)
    {
        $reflection = new \ReflectionClass(get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
