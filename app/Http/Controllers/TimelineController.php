<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function index(Project $project)
    {
        $timelines = $project->timelines;
        return response()->json($timelines);
    }

    public function store(Request $request, Project $project)
    {
        if (auth()->user()->role !== 'freelancer') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $project = Project::findOrFail($request->project_id);
        $timelineType = $project->timeline_type;

        // Validate input
        $request->validate([
            'milestone_dates' => 'required|array',
            'milestone_descriptions' => 'required|array',
            'week_numbers' => 'required|array',
            'files'       => 'nullable|file|mimes:jpg,png,pdf,docx,zip|max:2048',
        ]);

        $descriptions = $request->milestone_descriptions;
        $dates = $request->milestone_dates;
        $weeks = $request->week_numbers;

        
        if ($request->hasFile('files')) {
            $validated['files'] = $request->file('files')->store('timelines', 'public');
        }


        if ($timelineType === 'weekly') {
            // For weekly, validate that only one date is provided (first milestone)
            if (count($dates) !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'For weekly timeline, only the first milestone date should be provided.'
                ], 400);
            }

            // Generate weekly milestones starting from the first date
            $firstDate = Carbon::parse($dates[0]);
            $deadline = Carbon::parse($project->deadline);
            $generatedDates = [];
            $currentDate = $firstDate;
            $weekNumber = 1;

            // Generate milestones every 7 days until the deadline
            while ($currentDate->lte($deadline)) {
                $generatedDates[] = $currentDate->format('Y-m-d');
                $currentDate = $currentDate->copy()->addDays(7);
                $weekNumber++;
            }

            // If the last milestone is within 7 days of the deadline, add the deadline as the final milestone
            $lastMilestoneDate = Carbon::parse(end($generatedDates));
            if ($deadline->diffInDays($lastMilestoneDate) < 7 && $deadline->gt($lastMilestoneDate)) {
                $generatedDates[] = $deadline->format('Y-m-d');
            }

            // Ensure descriptions match the number of generated dates
            if (count($descriptions) !== count($generatedDates)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Number of descriptions must match the generated weekly milestones.'
                ], 400);
            }

            // Process generated dates
            foreach ($generatedDates as $index => $date) {
                $existingTimeline = Timeline::where('project_id', $project->id)
                    ->where('due_date', $date)
                    ->first();

                if ($existingTimeline) {
                    // Update existing timeline
                    $existingTimeline->update([
                        'description' => $descriptions[$index],
                        'week_number' => $index + 1,
                    ]);
                } else {
                    // Create new timeline
                    Timeline::create([
                        'project_id' => $project->id,
                        'type' => $project->timeline_type,
                        'title' => $project->title,
                        'description' => $descriptions[$index],
                        'week_number' => $index + 1,
                        'due_date' => $date,
                        'status' => $request->status ?? 'belum selesai',
                    ]);
                }
            }
        } else {
            // For daily timeline, keep the existing logic
            foreach ($descriptions as $index => $description) {
                $existingTimeline = Timeline::where('project_id', $project->id)
                    ->where('due_date', $dates[$index])
                    ->first();

                if ($existingTimeline) {
                    // Update existing timeline
                    $existingTimeline->update([
                        'description' => $description,
                        'week_number' => $weeks[$index],
                    ]);
                } else {
                    // Create new timeline
                    Timeline::create([
                        'project_id' => $project->id,
                        'type' => $project->timeline_type,
                        'title' => $project->title,
                        'description' => $description,
                        'week_number' => $weeks[$index],
                        'due_date' => $dates[$index],
                        'status' => $request->status ?? 'belum selesai',
                    ]);
                }
            }
        }

        // Return JSON with the updated milestones
        if ($request->expectsJson()) {
            $milestones = Timeline::where('project_id', $project->id)
                ->orderBy('due_date')
                ->get()
                ->map(function ($timeline) {
                    return [
                        'id' => $timeline->id,
                        'milestone_date' => $timeline->due_date,
                        'description' => $timeline->description,
                        'week_number' => $timeline->week_number,
                        'status' => $timeline->status,
                        'due_date' => $timeline->due_date
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Milestones berhasil disimpan!',
                'milestones' => $milestones
            ]);
        }

        return redirect()->back()->with('success', 'Milestones berhasil disimpan!');
    }

    // Other methods remain unchanged
    public function show(Project $project, Timeline $timeline)
    {
        $project->load('timelines');
        return view('client.timeline', compact('project'));
    }

    public function update(Request $request, Project $project, Timeline $timeline)
    {
        $data = $request->validate([
            'type' => 'required|in:weekly,daily',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'week_number' => 'nullable|integer',
            'due_date' => 'nullable|date',
            'status' => 'in:belum selesai,selesai',
        ]);

        $timeline->update($data);

        return response()->json($timeline);
    }

    public function updateStatus(Request $request, Project $project, Timeline $timeline)
    {
        if (auth()->user()->role !== 'freelancer') {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        if ($timeline->project_id !== $project->id) {
            return response()->json(['success' => false, 'message' => 'Milestone tidak terkait dengan project ini'], 400);
        }

        $request->validate([
            'status' => 'required|in:selesai,belum selesai',
        ]);

        $timeline->status = $request->input('status');
        $timeline->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'timeline' => $timeline
        ]);
    }

    public function destroy(Project $project, Timeline $timeline)
    {
        $timeline->delete();
        return response()->json(null, 204);
    }

    public function timeline(Project $project)
    {
        $existingMilestones = Timeline::where('project_id', $project->id)
            ->orderBy('due_date')
            ->get()
            ->map(function ($timeline) {
                return [
                    'id' => $timeline->id,
                    'milestone_date' => $timeline->due_date,
                    'description' => $timeline->description,
                    'week_number' => $timeline->week_number,
                    'status' => $timeline->status,
                    'due_date' => $timeline->due_date
                ];
            });

        $project->timelines = $existingMilestones;
        $project->timeline_type = $project->timeline_type; // Ensure timeline_type is passed to the view

        return view('freelancer.timeline', compact('project'));
    }

    public function getProgressAttribute()
    {
        $total = $this->timelines()->count();
        $completed = $this->timelines()->where('status', 'selesai')->count();

        return $total > 0 ? round(($completed / $total) * 100, 2) : 0;
    }
}