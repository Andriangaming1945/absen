@extends('main')

@section('slot')
<h3>{{ $title }}</h3>
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    <x-modal id="" label="Create Data" action="/classrooms" name="create">
        <div class="mb-3">
            <label for="create-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="create-name" name="name" placeholder="Name">
        </div>
    </x-modal>
    <x-table :columns="['No', 'Name', 'Action']">
        @foreach ($classrooms as $classrooms)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $classrooms->name }}</td>
            <td>
                <button class="badge border-0 bg-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $classrooms->id }}"><i class="fa-solid fa-pencil"></i></button>
                <x-modal :id="$classrooms->id" label="Edit Data" :action="'/classrooms/' . $classrooms->id" name="edit">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $classrooms->name }}" placeholder="Name">
                    </div>
                </x-modal>
                <button class="badge border-0 bg-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $classrooms->id }}"><i class="fa-solid fa-trash"></i></button>
                <x-modal :id="$classrooms->id" label="Delete Data" :action="'/classrooms/' . $classrooms->id" name="delete">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $classrooms->name }}" readonly placeholder="Name">
                    </div>
                </x-modal>
            </td>
        </tr>
        @endforeach
    </x-table>
@endsection
