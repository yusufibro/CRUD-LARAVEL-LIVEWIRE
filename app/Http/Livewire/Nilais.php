<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Nilai;
use App\Models\Post;
use App\Models\Matakuliah;

class Nilais extends Component
{
    use WithPagination;

    public $search;
    public $nilaiId, $id_nilai,$id_mahasiswa, $id_matakuliah, $nilai;
    public $isOpen = 0;

    public function render()
    {
        $searchParams = '%'.$this->search.'%';
        return view('livewire.nilais', [
            'nilais' => Nilai::where('nilai','like',$searchParams)->latest()->paginate(5)
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
                'id_nilai' => 'required',
                'nilai' => 'required',
            ]
        );

        Nilai::updateOrCreate(['id' => $this->nilaiId],[
            'id_nilai' => $this->id_nilai,
            'id_mahasiswa' => $this->id_mahasiswa,
            'id_matakuliah' => $this->id_matakuliah,
            'nilai' => $this->nilai,
        ]);

        $this->hideModal();

        session()->flash('notif', $this->nilaiId ? 'Nilai Update Berhasil' : 'Nilai Created Berhasil');

        $this->nilaiId = '';
        $this->id_nilai = '';
        $this->id_mahasiswa = '';
        $this->id_matakuliah = '';
        $this->nilai = '';
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $this->nilaiId = $id;
        $this->id_nilai = $nilai->id_nilai;
        $this->id_mahasiswa = $nilai->id_mahasiswa;
        $this->id_matakuliah = $nilai->id_matakuliah;
        $this->nilai = $nilai->nilai;

        $this->showModal();
    }

    public function delete($id)
    {
        Nilai::find($id)->delete();
        session()->flash('delete', 'Nilai Berhasil Di Hapus');
    }
}
