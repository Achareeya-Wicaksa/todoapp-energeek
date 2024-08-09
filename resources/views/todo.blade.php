@extends('layouts.master')

@section('title', 'Todo List')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@section('content')
<div class="text-center mt-5">
    <img src="{{ asset('images/image.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
</div>
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form id="todo-form" action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- Input for Name, Username, Email -->
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="flex-fill mr-2">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control mt-3" placeholder="Nama" required>
                                </div>
                                <div class="flex-fill mx-2">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control mt-3" placeholder="Username" required>
                                </div>
                                <div class="flex-fill ml-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control mt-3" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                        <div id="todo-list">
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <h3 class="">To Do List</h3>
                                    <div class="form-group mb-0 ml-auto">
                                             <button type="button" id="add-todo" class="btn" style="background-color: #FFC0CB; color: #000;">+ Tambah To Do</button>
                                    </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-8">
                                    <label for="description">Judul To Do</label>
                                    <input type="text" name="tasks[0][description]" class="form-control mt-3" placeholder="Contoh: Perbaikan api master" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="category_id">Kategori</label>
                                    <select name="tasks[0][category_id]" class="form-control mt-3" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-todo">
                                        <i class="bi bi-trash fs-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </div>
                    </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Data berhasil disimpan!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    console.log('Script loaded and DOM ready');

    let taskCount = 1;

    // Event listener untuk menambah task baru
    document.getElementById('add-todo').addEventListener('click', function () {
        const todoList = document.getElementById('todo-list');
        const newTask = `
            <div class="form-group row">
                <div class="col-md-8">
                    <input type="text" name="tasks[${taskCount}][description]" class="form-control" placeholder="Contoh: Perbaikan api master" required>
                </div>
                <div class="col-md-3">
                    <select name="tasks[${taskCount}][category_id]" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-todo">&times;</button>
                </div>
            </div>
        `;
        todoList.insertAdjacentHTML('beforeend', newTask);
        taskCount++;
    });

    document.getElementById('todo-list').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-todo')) {
            e.target.closest('.form-group.row').remove();
        }
    });

    document.getElementById('todo-form').addEventListener('submit', function (e) {
        e.preventDefault(); 
        console.log('Form submitted via JavaScript');
        const form = document.getElementById('todo-form');
        const formData = new FormData(form);

        axios.post(`{{ route('tasks.store') }}`, formData)
            .then(response => {
                console.log('Response:', response);
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                form.reset();
                taskCount = 1;
                document.getElementById('todo-list').innerHTML = '';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            });
    });
});

</script>
@endsection
