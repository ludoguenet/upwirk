<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Proposal;
use App\Models\CoverLetter;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function submit(Job $jobId)
    {
        return view('proposals.submit', compact('jobId'));
    }

    public function submitStore(Request $request, Job $jobId)
    {
        $request->validate([
            'coverLetter' => 'required|max:255' 
        ]);

        $proposal = Proposal::create([
            'job_id' => $jobId->id
        ]);

        CoverLetter::create([
            'proposal_id' => $proposal->id,
            'content' => $request->input('coverLetter')
        ]);
 
        return redirect()->route('jobs.index');
    }

    public function home()
    {
        $proposals = auth()->user()->proposals()->get();

        return view('home', compact('proposals'));
    }
}
