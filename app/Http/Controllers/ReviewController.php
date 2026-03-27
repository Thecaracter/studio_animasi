<?php

namespace App\Http\Controllers;

use App\Models\TaskSubmission;
use App\Models\TaskReview;
use App\Models\PerformanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function listSubmissions()
    {
        $submissions = TaskSubmission::where('status', 'pending_review')
            ->with('task', 'submittedBy', 'review')
            ->get();

        return view('reviews.list', ['submissions' => $submissions]);
    }

    public function showSubmission(TaskSubmission $submission)
    {
        return view('reviews.show', [
            'submission' => $submission->load('task', 'submittedBy', 'review'),
        ]);
    }

    public function approveForm(TaskSubmission $submission)
    {
        return view('reviews.approve', ['submission' => $submission->load('task', 'submittedBy')]);
    }

    public function approve(Request $request, TaskSubmission $submission)
    {
        $validated = $request->validate([
            'feedback' => 'nullable|string',
        ]);

        // Create review record
        TaskReview::create([
            'task_submission_id' => $submission->id,
            'reviewed_by_id' => Auth::id(),
            'feedback' => $validated['feedback'],
            'status' => 'approved',
            'reviewed_at' => now(),
        ]);

        // Update submission and task status
        $submission->update(['status' => 'approved']);
        $dueDate = $submission->task->due_date;
        $isOnTime = now()->lessThanOrEqualTo($dueDate);

        // Create performance log
        PerformanceLog::create([
            'user_id' => $submission->submitted_by_id,
            'task_id' => $submission->task_id,
            'is_on_time' => $isOnTime,
            'completed_at' => now(),
        ]);

        $submission->task->update(['status' => 'approved']);

        return redirect()->route('reviews.list')
            ->with('success', 'Tugas berhasil diapprove');
    }

    public function rejectForm(TaskSubmission $submission)
    {
        return view('reviews.reject', ['submission' => $submission->load('task', 'submittedBy')]);
    }

    public function reject(Request $request, TaskSubmission $submission)
    {
        $validated = $request->validate([
            'feedback' => 'required|string',
        ]);

        // Create review record
        TaskReview::create([
            'task_submission_id' => $submission->id,
            'reviewed_by_id' => Auth::id(),
            'feedback' => $validated['feedback'],
            'status' => 'rejected',
            'reviewed_at' => now(),
        ]);

        // Update status to rejected
        $submission->update(['status' => 'rejected']);
        $submission->task->update(['status' => 'rejected']);

        return redirect()->route('reviews.list')
            ->with('success', 'Tugas berhasil ditolak. Editor harus mengerjakan ulang');
    }
}
