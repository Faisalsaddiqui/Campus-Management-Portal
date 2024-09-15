<?php

namespace Tests\Feature\Http\Middleware;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    public function test_all_admin_routes_have_auth_middleware()
    {
        /** @var Router $router */
        $router = app('router');

        /** @var Collection|Route[] $routes */
        $unprotected_routes = collect($router->getRoutes())->filter(function (Route $route) {
            if (!preg_match('/^admin/', $route->getName())) {
                return false;
            }

            return !in_array('auth', $route->gatherMiddleware());
        });

        $message = $unprotected_routes->map(function (Route $route) {
            return sprintf('Route `%s` (%s) is missing `auth` middleware', $route->uri(), $route->getName());
        })->implode("\n");

        $this->assertCount(0, $unprotected_routes, $message);
    }

    public function test_all_admin_routes_have_role_admin_middleware()
    {
        /** @var Router $router */
        $router = app('router');

        /** @var Collection|Route[] $routes */
        $unprotected_routes = collect($router->getRoutes())->filter(function (Route $route) {
            if (!preg_match('/^admin/', $route->getName())) {
                return false;
            }

            return !in_array('role:admin', $route->gatherMiddleware());
        });

        $message = $unprotected_routes->map(function (Route $route) {
            return sprintf('Route `%s` (%s) is missing `auth` middleware', $route->uri(), $route->getName());
        })->implode("\n");

        $this->assertCount(0, $unprotected_routes, $message);
    }
}
