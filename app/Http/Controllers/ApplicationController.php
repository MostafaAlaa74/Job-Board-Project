<?php

namespace App\Http\Controllers;

use App\Events\ApplicationApplyed;
use App\Models\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Job;
use App\Notifications\AcceptApplicationNotificaion;
use App\Notifications\ApplingToJobNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())->paginate(10);
        return view('applications.index', compact('applications'));
    }

    // public function GetJobApp($job_id){
    //     $applications = Application::where('job_id' , $job_id);
    //     return
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        $application = Application::create([
            'user_id' => Auth::id(),
            'job_id' => $request->job_id,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $request->file('resume')->store('resumes', 'public'),
        ]);
        event(new ApplicationApplyed($application));
        return redirect()->route('jobs.show', $request->job_id)
            ->with('success', 'Application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    public function AcceptApplication(Application $application)
    {
        if (!Gate::allows('Craete_Job')) {
            return abort(403, 'Unauthorized action.');
        }
        $application->update(['status' => 'accepted']);
        // Send notification to the seeker
        $application->user->notify(new AcceptApplicationNotificaion($application));
        return redirect()->route('jobs.applications', $application->job_id)
            ->with('success', 'Application accepted successfully.');
    }

    public function RejectApplication(Application $application)
    {
        if (!Gate::allows('Craete_Job')) {
            return abort(403, 'Unauthorized action.');
        }
        $application->update(['status' => 'rejected']);
        return redirect()->route('jobs.applications', $application->job_id)
            ->with('success', 'Application Rejected successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if (!Gate::allows('Delete_Job')) {
            return abort(403, 'Unauthrized');
        }
        $application->delete();
        return redirect()->route('applications.index');
    }
}
