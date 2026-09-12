<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Show a single project's detail page.
     */
    public function show(string $project): View
    {
        $data = collect(config('portfolio.projects'))
            ->firstWhere('slug', $project);

        abort_if(is_null($data), 404);

        // Fall back to the card thumbnail if no dedicated gallery was set.
        $data['gallery'] = $data['gallery'] ?? [$data['thumbnail']];

        return view('projects.show', ['project' => $data]);
    }
}
