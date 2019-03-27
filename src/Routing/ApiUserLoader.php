<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 3.03.19
 * Time: 20:42
 */

namespace Sf4\ApiUser\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class ApiUserLoader extends Loader
{
    public const TYPE = 'sf4_api_user';

    /** @var bool $isLoaded */
    protected $isLoaded = false;

    /**
     * @param mixed $resource
     * @param null $type
     * @return RouteCollection|null
     */
    public function load($resource, $type = null): RouteCollection
    {
        if (true === $this->isLoaded) {
            return null;
        }

        $routes = new RouteCollection();
        $routes->addCollection(
            $this->import(
                '@Sf4ApiUserBundle/Resources/config/routes.yaml',
                'yaml'
            )
        );

        $this->isLoaded = true;

        return $routes;
    }

    /**
     * @param mixed $resource
     * @param null $type
     * @return bool
     */
    public function supports($resource, $type = null): bool
    {
        return static::TYPE === $type;
    }
}
