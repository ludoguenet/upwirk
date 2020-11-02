<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\CoverLetter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'user_id', 'validated'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function coverLetter()
    {
        return $this->hasOne(CoverLetter::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProposalCoverLetter($query)
    {
        return $query->select('content')
            ->from('cover_letters')
            ->join('proposals', 'cover_letters.proposal_id', '=', 'proposals.id')
            ->where('proposal_id', $this->id)
            ->first()
            ->content;
    }
}
