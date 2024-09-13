<?php

namespace App\Http\Controllers\Forms;

use App\Http\Requests\Templates\FormTemplateRequest;
use App\Http\Resources\FormTemplateResource;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    /**
     * Retrieve production templates from an external API if the application is in self-hosted mode.
     * Optionally filter the templates by a specific slug.
     *
     * @param bool $slug
     * @return array
     */
    private function getProdTemplates($slug = false)
    {
        // Check if the application is in self-hosted mode
        if (!config('app.self_hosted')) {
            return [];
        }

        // Retrieve the production templates from the cache or fetch them from the external API if not cached
        $prodTemplates = \Cache::remember('prod_templates', 3600, function () {
            $response = Http::get('https://api.opnform.com/templates');
            if ($response->successful()) {
                return collect($response->json())->map(function ($item) {
                    $item['from_prod'] = true;
                    return $item;
                })->toArray();
            }
        });

        // If a slug is provided, filter the templates by the slug
        if ($slug) {
            return collect($prodTemplates)->filter(function ($item) use ($slug) {
                return $item['slug'] === $slug;
            })->toArray();
        }

        return $prodTemplates;
    }

    /**
     * Display a listing of the templates.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Get the limit and onlyMy parameters from the request
        $limit = (int) $request->get('limit', 0);
        $onlyMy = (bool) $request->get('onlymy', false);

        // Create a query for the Template model
        $query = Template::query();

        // If the user is authenticated, filter the templates based on the onlyMy parameter
        if (Auth::check()) {
            if ($onlyMy) {
                $query->where('creator_id', Auth::id());
            } else {
                $query->where(function ($q) {
                    $q->where('publicly_listed', true)
                        ->orWhere('creator_id', Auth::id());
                });
            }
        } else {
            // If the user is not authenticated, only show publicly listed templates
            $query->where('publicly_listed', true);
        }

        // If a limit is provided, apply it to the query
        if ($limit > 0) {
            $query->limit($limit);
        }

        // Get the templates ordered by creation date in descending order
        $templates = $query->orderByDesc('created_at')->get();

        // Return the templates as a JSON response, including production templates if applicable
        return response()->json(array_merge(
            FormTemplateResource::collection($templates)->toArray($request),
            $this->getProdTemplates()
        ));
    }

    /**
     * Create a new template.
     *
     * @param FormTemplateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(FormTemplateRequest $request)
    {
        // Authorize the user to create a template
        $this->authorize('create', Template::class);

        // Create and save the template
        $template = $request->getTemplate();
        $template->save();

        // Return a success response with the created template data
        return $this->success([
            'message' => 'Template was created.',
            'template_id' => $template->id,
            'data' => new FormTemplateResource($template),
        ]);
    }

    /**
     * Update an existing template.
     *
     * @param FormTemplateRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FormTemplateRequest $request, string $id)
    {
        // Find the template by ID and authorize the user to update it
        $template = Template::findOrFail($id);
        $this->authorize('update', $template);

        // Update the template with the request data
        $template->update($request->all());

        // Return a success response with the updated template data
        return $this->success([
            'message' => 'Template was updated.',
            'template_id' => $template->id,
            'data' => new FormTemplateResource($template),
        ]);
    }

    /**
     * Delete an existing template.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the template by ID and authorize the user to delete it
        $template = Template::findOrFail($id);
        $this->authorize('delete', $template);

        // Delete the template
        $template->delete();

        // Return a success response indicating the template was deleted
        return $this->success([
            'message' => 'Template was deleted.',
        ]);
    }

    /**
     * Display a specific template by slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse|FormTemplateResource
     */
    public function show(string $slug)
    {
        // Find the template by slug
        $template = Template::whereSlug($slug)->first();

        // If the template exists, return it as a resource, otherwise return production templates filtered by slug
        return ($template) ? new FormTemplateResource($template) : $this->getProdTemplates($slug);
    }
}
