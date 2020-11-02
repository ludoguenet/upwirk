<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProposalExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $jobId = $request->jobId->id;

        if (auth()->user()->proposals->contains('job_id', $jobId)) {
            return redirect()->route('jobs.index');
        }

        return $next($request);
    }
}
