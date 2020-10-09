<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Matakuliah;

class Matakuliahs extends Component
{
    use WithPagination;

    public $search;
    public $matakuliahId, $id_matakuliah, $nama_matakuliah;
    public $isOpen = 0;

    public function render()
    {
        $searchParams = '%'.$this->search.'%';
        return view('livewire.matakuliahs', [
            'matakuliahs' => Matakuliah::where('nama_matakuliah','like',$searchParams)->latest()->paginate(5)
        ]);
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate(
            [
                'id_matakuliah' => 'required',
                'nama_matakuliah' => 'required',
            ]
        );

        Matakuliah::updateOrCreate(['id' => $this->matakuliahId],[
            'id_matakuliah' => $this->id_matakuliah,
            'nama_matakuliah' => $this->nama_matakuliah,
        ]);

        $this->hideModal();

        session()->flash('notif', $this->matakuliahId ? 'Update Berhasil' : 'Created Berhasil');

        $this->matakuliahId = '';
        $this->id_matakuliah = '';
        $this->nama_matakuliah = '';
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $this->matakuliahId = $id;
        $this->id_matakuliah = $matakuliah->id_matakuliah;
        $this->nama_matakuliah = $matakuliah->nama_matakuliah;

        $this->showModal();
    }

    public function delete($id)
    {
        Matakuliah::find($id)->delete();
        session()->flash('delete', 'Berhasil Di Hapus');
    }

}
