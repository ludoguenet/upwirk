<?php

namespace App\Models;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoverLetter extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id', 'content'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
