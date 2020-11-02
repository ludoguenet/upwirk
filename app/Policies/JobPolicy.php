<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Conversation;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function confirm(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }

    /**
     * Déterminer si les 2 utilisateurs de la conversation sont un utilisateur validé du job ou l'auteur du job.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @param  \App\Models\User  $receiver
     * @return mixed
     */
    public function view(User $user, Job $job, Conversation $conversation)
    {
        if ($user->id === $conversation->from) {
            return $user->id === $job->user_id;
        } else {
            return $user->proposals->contains(function ($value, $key) use ($job, $conversation, $user) {
                return $value['validated'] == 1
                    && $value['job_id'] == $job->id
                    && $conversation->to === $user->id;
            });
        }
    }
}
