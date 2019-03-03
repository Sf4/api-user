<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 27.02.19
 * Time: 9:42
 */

namespace Sf4\ApiUser\DependencyInjection;

use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Repository\UserDetailRepository;
use Sf4\ApiUser\Repository\UserRepository;
use Sf4\ApiUser\Request\DetailRequest;
use Sf4\ApiUser\Request\ListRequest;
use Sf4\ApiUser\Request\SaveDetailRequest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Sf4\Api\DependencyInjection\Configuration as Sf4ApiConfiguration;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class Sf4ApiUserExtension extends Extension implements PrependExtensionInterface
{

    const SF4_API_BUNDLE = 'Sf4ApiBundle';
    const SF4_API_SECURITY_BUNDLE = 'Sf4ApiSecurityBundle';
    const SF4_API_USER = 'sf4_api_user';

    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (isset($bundles[static::SF4_API_BUNDLE])) {
            $container->prependExtensionConfig(Sf4ApiConfiguration::NAME, [
                Sf4ApiConfiguration::ROUTES => $this->getRoutes()
            ]);
            $container->prependExtensionConfig(Sf4ApiConfiguration::NAME, [
                Sf4ApiConfiguration::ROUTES => $this->getLocaleRoutes()
            ]);
            if (false === isset($bundles[static::SF4_API_SECURITY_BUNDLE])) {
                $container->prependExtensionConfig(Sf4ApiConfiguration::NAME, [
                    Sf4ApiConfiguration::ENTITIES => $this->getEntities()
                ]);
            }
        }
    }

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    /**
     * @return array
     */
    protected function getRoutes()
    {
        return [
            [
                Sf4ApiConfiguration::ROUTES_ROUTE => DetailRequest::ROUTE,
                Sf4ApiConfiguration::ROUTES_REQUEST_CLASS => DetailRequest::class
            ],
            [
                Sf4ApiConfiguration::ROUTES_ROUTE => ListRequest::ROUTE,
                Sf4ApiConfiguration::ROUTES_REQUEST_CLASS => ListRequest::class
            ],
            [
                Sf4ApiConfiguration::ROUTES_ROUTE => SaveDetailRequest::ROUTE,
                Sf4ApiConfiguration::ROUTES_REQUEST_CLASS => SaveDetailRequest::class
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getLocaleRoutes()
    {
        $localeRoutes = [];
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $route[Sf4ApiConfiguration::ROUTES_ROUTE] = $this->addLocaleToRoute(
                $route[Sf4ApiConfiguration::ROUTES_ROUTE]
            );
            $localeRoutes[] = $route;
        }

        return $localeRoutes;
    }

    /**
     * @param string $route
     * @return mixed
     */
    protected function addLocaleToRoute(string $route)
    {
        return str_replace(
            static::SF4_API_USER,
            static::SF4_API_USER.'_locale',
            $route
        );
    }

    /**
     * @return array
     */
    protected function getEntities()
    {
        return [
            [
                Sf4ApiConfiguration::ENTITIES_TABLE_NAME => UserRepository::TABLE_NAME,
                Sf4ApiConfiguration::ENTITIES_ENTITY_CLASS => User::class
            ],
            [
                Sf4ApiConfiguration::ENTITIES_TABLE_NAME => UserDetailRepository::TABLE_NAME,
                Sf4ApiConfiguration::ENTITIES_ENTITY_CLASS => UserDetail::class
            ]
        ];
    }
}
