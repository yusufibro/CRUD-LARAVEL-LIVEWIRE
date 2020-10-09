<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Posts extends Component
{
    use WithPagination;

    public $search;
    public $postId, $id_mahasiswa, $nama_mahasiswa;
    public $isOpen = 0;

    public function render()
    {
        $searchParams = '%'.$this->search.'%';
        return view('livewire.posts', [
            'posts' => Post::where('nama_mahasiswa','like',$searchParams)->latest()->paginate(5)
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
                'id_mahasiswa' => 'required',
                'nama_mahasiswa' => 'required',
            ]
        );

        Post::updateOrCreate(['id' => $this->postId],[
            'id_mahasiswa' => $this->id_mahasiswa,
            'nama_mahasiswa' => $this->nama_mahasiswa,
        ]);

        $this->hideModal();

        session()->flash('notif', $this->postId ? 'Post Update Berhasil' : 'Post Created Berhasil');

        $this->postId = '';
        $this->id_mahasiswa = '';
        $this->nama_mahasiswa = '';
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->id_mahasiswa = $post->id_mahasiswa;
        $this->nama_mahasiswa = $post->nama_mahasiswa;

        $this->showModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('delete', 'Post Berhasil Di Hapus');
    }
}
