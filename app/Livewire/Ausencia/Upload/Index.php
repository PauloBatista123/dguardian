<?php

namespace App\Livewire\Ausencia\Upload;

use App\Imports\AusenciasImport;
use App\Models\UploadAusencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\HeadingRowImport;

class Index extends Component
{
    use WithPagination, WithFileUploads, LivewireAlert;

    #[Rule('required')]
    public $arquivo;

    public function render()
    {
        return view('livewire.ausencia.upload.index', [
            'importacoes' => UploadAusencia::paginate(10)
        ]);
    }

    public function salvar()
    {
        $this->validate();

        $headings = (new HeadingRowImport)->toArray($this->arquivo);

        if(array_diff(array('id', 'usuario', 'inicio', 'fim', 'tipo_de_ausencia', 'descricao'), $headings[0][0])){
            return $this->alert('info', 'O arquivo não possui informaçõe válidas');
        }

        (new AusenciasImport(Auth::user()->id))->import($this->arquivo);

        $path = Storage::putFile('public', $this->arquivo);

        UploadAusencia::create([
            'url' => $path,
            'nome' => $this->arquivo->getClientOriginalName(),
            'usuario_id' => Auth::user()->id,
        ]);

        $this->alert('success', 'Arquivo enviado para processamento');
    }
}
