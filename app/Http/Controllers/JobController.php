<?php

namespace App\Http\Controllers;

use App\Events\AcceptJob;
use App\Events\RejectJob;
use App\Models\Job;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Mail\SendRejectianJobMail;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->routeIs('home')) {
            $jobs = Job::with('company')->latest()->take(3)->get();
            return view('home', compact('jobs'));
        } else {
            $jobs = Job::with('company')->where('status', 'accepted')->Paginate(10);
            return view('jobs.index', compact('jobs'));
        }
    }

    public function pendingJobs()
    {
        if (Gate::allows('viewAny', Job::class)) {
            $jobs = Job::where('status', 'pending')->paginate(10);
            return view('jobs.pending', compact('jobs'));
        }
    }

    public function acceptJob(Job $job)
    {
        if (Gate::allows('acceptJob')) {
            $job->update(['status' => 'accepted']);
            $job->save();
            // Dispatch the AcceptJob event
            event(new AcceptJob($job));
            return redirect()->route('jobs.index')->with('success', 'Job accepted successfully.');
        }
    }
    public function rejectJob(Job $job)
    {
        if (Gate::allows('acceptJob')) {
            $job->update(['status' => 'rejected']);
            $job->save();
            event(new RejectJob($job));
            return redirect()->route('jobs.index')->with('success', 'Job rejected successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('Craete_Job')) {
            return view('jobs.create');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        Job::create($request->validated());
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        if (!Gate::allows('Update_Job', $job)) {
            return abort(403, 'Unauthorized action.');
        }
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        if (Gate::allows('Update_Job', $job)) {
            $job->update($request->validated());
            return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if (Gate::allows('Delete_Job')) {
            $job->delete();
            return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
        }
    }

    // Get The Application Which Applied to a specific job
    public function GetJobApp(Job $job)
    {
        $applications = $job->applications()->get();
        return view('jobs.applications', compact('job', 'applications'));
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;
        return response()->json($notifications);
    }

    public function notificationMarkAsRead(Request $request , $notificationId)
    {
        
        $notification = $request->user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            return back()->with('success', 'Notification marked as read.');
        }
    }
}
