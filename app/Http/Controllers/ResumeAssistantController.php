<?php

namespace App\Http\Controllers;

use OpenAI;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResumeAssistantController extends Controller
{
    /**
     * Displays the AI Resume Assistant view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('/projects/resume-builder', [
            'metaTitle' => 'AI Resume Assistant - Farzan Yazdanjou',
            'metaDescription' => "Looking for an easier way to create a professional resume? AI Resume Assistant is here to help! My project uses artificial intelligence to take basic information about your experiences and generate polished resume content. Simply enter your work history, education, and skills, and let AI do the rest. Try it out today and streamline your job search!",
            'metaImage' => 'openai.jpg',
        ]);
    }

    /**
     * Uses the given information to generate resume content.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse Resume content object
     */
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'current' => 'required|string|max:500',
            'years' => 'nullable|string|max:3',
            'education' => 'nullable|string|max:500',
            'softSkills' => 'nullable|string|max:500',
            'hardSkills' => 'nullable|string|max:500',
            'experiences' => 'nullable|array',
            'experiences[*]' => 'nullable|string|max:500',
        ]);

        $currentPosition = $attributes['current'];
        $education = $attributes['education'] ? "I have the following education: " . $attributes['education'] : '';
        $softSkills = $attributes['softSkills'];
        $hardSkills = $attributes['hardSkills'];
        $experiences = $attributes['experiences'];
        $allExperiences = '';

        foreach ($experiences as $experience) {
            $allExperiences = $allExperiences . $experience . "\n";
        }

        $years = 'without any professional experience yet';
        if ($attributes['years'] !== '0') {
            $years = 'with ' . $attributes['years'] . ' years of experience';
        }

        $summaryPrompt = "Please write me a 4-5 sentence resume summary for a" . $currentPosition . $years . ". I want a summary that outlines my technical and professional skills, while showing that I am a good team-member. You can consider but are not required to use or limited to the following information about me:\n" . $softSkills . "\n" . $hardSkills . ". I also have the following experience:\n" . $allExperiences . ". " . $education . ". Please provide a single paragraph with no line breaks.";

        $educationPrompt = "Please write me a single point-form resume summary of my education that is as follows (do not attempt to autocomplete): \n" . $attributes['education'] . ". If I mention a GPA, courses, or grades, please try to include that information in the resume summary. Try to keep the summary just about education.";

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $result = [];
        $result['summary'] = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $summaryPrompt,
            'max_tokens' => 500,
            'temperature' => 0.9,
        ])['choices'][0]['text'];

        if ($attributes['education'] !== '') {
            $result['education'] = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $educationPrompt,
                'max_tokens' => 500,
                'temperature' => 0.9,
            ])['choices'][0]['text'];
        }

        for ($i = 0; $i < count($experiences); $i++) {
            $experiencePrompt = "Please write me 5 bullet points (each 1-2 sentences long) for a resume that highlights my experiences and skills from a past position. Here are details about the experience:\n" . $experiences[$i];

            $result['experiences'][$i] = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $experiencePrompt,
                'max_tokens' => 500,
                'temperature' => 0.9,
            ])['choices'][0]['text'];
        }

        return response()->json(['data' => $result]);
    }
}