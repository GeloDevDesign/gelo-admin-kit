<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\CreateProject;
use Laravel\Mcp\Server;

class PublicServer extends Server
{
    protected string $name = 'Gelo MCP Server';

    protected string $version = '0.0.1';

    protected string $instructions = <<<'MARKDOWN'
        This MCP server exposes basic access to the Gelo Laravel application.
    MARKDOWN;

    /**
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        CreateProject::class,
    ];

    /**
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [];

    /**
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [];
}
