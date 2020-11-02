<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alert extends Component
{
    protected $listeners = ['flash-message' => 'setAlert'];
    public $type = 'success';
    public $styleByType = [
        'success' => 'bg-green-100 border-green-700 text-green-700',
        'info' => 'bg-blue-100 border-blue-700 text-blue-700',
        'warning' => 'bg-yellow-100 border-yellow-700 text-yellow-700',
        'error' => 'bg-red-100 border-red-700 text-red-700',
    ];
    public $message;

    public function setAlert($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
        $this->dispatchBrowserEvent('flash');
    }

    public function render()
    {
        return view('livewire.alert');
    }
}
