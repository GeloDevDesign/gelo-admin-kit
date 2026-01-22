<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class McpCreateProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_mcp_can_create_project(): void
    {
        $payload = [
            'jsonrpc' => '2.0',
            'id' => '1',
            'method' => 'tools/call',
            'params' => [
                'name' => 'create-project',
                'arguments' => [
                    'name' => 'MCP Project',
                ],
            ],
        ];

        $response = $this->postJson('/mcp/public', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('projects', [
            'name' => 'MCP Project',
        ]);

        $data = $response->json();

        $this->assertSame('2.0', $data['jsonrpc'] ?? null);
        $this->assertSame('1', $data['id'] ?? null);
    }
}
