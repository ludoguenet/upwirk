<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $jobs = [];
    public $selectedIndex = 0;

    public function incrementIndex()
    {
        if ($this->selectedIndex === (count($this->jobs) - 1))
        {
            $this->selectedIndex = 0;
            return;
        }

        $this->selectedIndex++;
    }

    public function decrementIndex()
    {
        if ($this->selectedIndex === 0)
        {
            $this->selectedIndex = count($this->jobs) - 1;
            return;
        }

        $this->selectedIndex--;
    }

    public function selectIndex()
    {
        if ($this->jobs) {
            $this->redirect(route('jobs.show', $this->jobs[$this->selectedIndex]['id']));
        }
    }

    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }

    public function render()
    {
        return view('livewire.search', [
            'jobs' => $this->jobs
        ]);
    }

    public function updatedQuery()
    {
        $this->resetIndex();
        
        $words = '%' . $this->query . '%';

        if (strlen($this->query) >= 2) {
            $this->jobs = Job::where('title', 'like', $words)->get()->toArray();
        }
    }
}
