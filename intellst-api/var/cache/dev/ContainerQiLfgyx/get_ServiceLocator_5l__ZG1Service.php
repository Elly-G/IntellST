<?php

namespace ContainerQiLfgyx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_5l__ZG1Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.5l..ZG1' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.5l..ZG1'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'enterprise' => ['privates', '.errored..service_locator.5l..ZG1.App\\Entity\\Enterprise', NULL, 'Cannot autowire service ".service_locator.5l..ZG1": it references class "App\\Entity\\Enterprise" but no such service exists.'],
        ], [
            'enterprise' => 'App\\Entity\\Enterprise',
        ]);
    }
}
