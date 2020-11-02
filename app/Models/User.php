<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Role;
use App\Models\Proposal;
use App\Models\Conversation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Job::class)->withTimestamps()->orderByDesc('job_user.created_at');
    }

    public function conversations()
    {
        return Conversation::where(function ($q) {
            $q->where('to', $this->id)
                ->orWhere('from', $this->id);
        });
    }

    public function getConversationsAttribute()
    {
        return $this->conversations()->get();
    }
}
