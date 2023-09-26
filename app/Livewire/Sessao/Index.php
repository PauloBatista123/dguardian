<?php

namespace App\Livewire\Sessao;

use App\Models\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.sessao.index', [
            'sessions' => Session::whereNotNull('user_id')->orderBy('last_activity', 'desc')->paginate(10)
        ]);
    }
}
