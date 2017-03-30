<?php

namespace Naoray\Larablog\Test;

class RouteTest extends TestCase
{
    /** @test */
    public function it_returns_true_if_the_blog_route_is_visitable()
    {
        $response = $this->get(config('larablog.route'));

        $response->assertStatus(200);
    }
}
