@extends('layouts.master')

@section('title', 'Todo List')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">To Do List</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <!-- Input for Name -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>

                        <!-- Input for Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <!-- Input for Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <!-- To-Do List Entries -->
                        <div id="todo-list">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="description">Judul To Do</label>
                                    <input type="text" name="tasks[0][description]" class="form-control" placeholder="Contoh: Perbaikan api master" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="category_id">Kategori</label>
                                    <select name="tasks[0][category_id]" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-todo">&times;</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" id="add-todo" class="btn btn-pink">+ Tambah To Do</button>
                        </div>

                        <!-- Save Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let taskCount = 1;

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
</script>
@endsection
