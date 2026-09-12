<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectPageTest extends TestCase
{
    public function test_a_known_project_slug_shows_its_detail_page(): void
    {
        $response = $this->get('/work/dmart');

        $response->assertStatus(200);
        $response->assertSee('DMART');
        $response->assertSee('Visit live site');
    }

    public function test_an_unknown_project_slug_returns_404(): void
    {
        $response = $this->get('/work/does-not-exist');

        $response->assertStatus(404);
    }
}
