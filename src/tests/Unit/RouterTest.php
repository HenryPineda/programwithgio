<?php

namespace Tests\Unit;
use App\Exceptions\RouteNotFoundException;
use App\Router;
use \PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;
    public function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    /** @test */
    public function it_registers_a_route():void
    {

        $this->router->register('get', '/users', ['UserController', 'index']);
        $expected = [
            'get' => [
                '/users' => ['UserController', 'index']
            ]
        ];

        //Assert the route has been register
        $this->assertEquals($expected, $this->router->getRoutes());


    }
    /** @test */
    public function it_registers_a_get_route(): void
    {

        $this->router->get('/users', ['UserController', 'index']);
        $expected = [
            'get' => [
                '/users' => ['UserController', 'index']
            ]
        ];

        //Assert the route has been register
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {

        $this->router->post('/users', ['UserController', 'store']);
        $expected = [
            'post' => [
                '/users' => ['UserController', 'store']
            ]
        ];

        //Assert the route has been register
        $this->assertEquals($expected, $this->router->getRoutes());
    }

    /** @test */
    public function there_are_no_routes_when_router_is_created(): void
    {
        //Given a I have router
        $router = new Router();

        $this->assertEmpty($router->getRoutes());

    }
    /**
     * @test
     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases()
     */
    public function it_throws_route_not_found_exception(string $requestURI, string $requestMethod):void
    {
        $users = new class(){
            public function delete():bool
            {
                return true;
            }
        };
        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', ['UserController', 'index']);
        var_dump(class_exists('UserController'));

        //We want to assert that when we try to resolve a route a RouteNotFoundException is thrown
        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestURI, $requestMethod);
    }
    /** @test */
    public function it_resolves_a_route_from_a_closure(): void
    {

        $this->router->get('/users', fn() => [1,2,3]);

        $this->assertEquals([1,2,3], $this->router->resolve('/users', 'get'));
    }

    /** @test */
    public function it_resolves_a_route_from_a_class_method(): void
    {
        $users = new class(){
            public function index():array
            {
                return [1, 2, 3];
            }
        };
        $this->router->get('/users', [$users::class, 'index']);

        $this->assertSame([1,2,3], $this->router->resolve('/users', 'get'));
    }




}