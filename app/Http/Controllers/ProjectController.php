<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Displays a view of all projects.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function all()
    {
        return view('projects', [
            'projects'  => Project::latest('created_at')->get(),
            'metaTitle' => 'Projects - Farzan Yazdanjou',
            'metaDescription' => "Learn about the various software development projects I've tackled as I strive to improve my skills and share my knowledge. Check out my progress and see how I'm constantly growing as a developer.",
            'metaImage' => 'cover-photo.jpg',
        ]);
    }
}
