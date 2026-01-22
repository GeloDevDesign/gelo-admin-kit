<?php

namespace App\Mcp\Tools;

use App\Models\Project;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;

class CreateProject extends Tool
{
    protected string $description = <<<'MARKDOWN'
        Create a new project by providing a name. Returns the created project.
    MARKDOWN;

    public function handle(Request $request): Response
    {
        $data = $request->all();

        $name = (string) ($data['name'] ?? '');

        if ($name === '') {
            return Response::text('The "name" field is required to create a project.');
        }

        $project = Project::create([
            'name' => $name,
        ]);

        return Response::json([
            'id' => $project->id,
            'name' => $project->name,
            'status' => $project->status,
            'created_at' => $project->created_at?->toAtomString(),
        ]);
    }

    /**
     * @return array<string, JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'name' => $schema->string()->minLength(1)->maxLength(255),
        ];
    }
}
