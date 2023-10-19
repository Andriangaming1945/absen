@extends('main')

@section('slot')
<h3>{{ $title }}</h3>
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    <x-modal id="" label="Create Data" action="/information-permits" name="create">
        <div class="mb-3">
            <label for="create-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="create-name" name="name" placeholder="Name">
        </div>
    </x-modal>
    <x-table :columns="['No', 'Name', 'Action']">
        @foreach ($information_permits as $information_permit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $information_permit->name }}</td>
            <td>
                <button class="badge border-0 bg-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $information_permit->id }}"><i class="fa-solid fa-pencil"></i></button>
                <x-modal :id="$information_permit->id" label="Edit Data" :action="'/information-permits/' . $information_permit->id" name="edit">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $information_permit->name }}" placeholder="Name">
                    </div>
                </x-modal>
                <button class="badge border-0 bg-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $information_permit->id }}"><i class="fa-solid fa-trash"></i></button>
                <x-modal :id="$information_permit->id" label="Delete Data" :action="'/information-permits/' . $information_permit->id" name="delete">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $information_permit->name }}" readonly placeholder="Name">
                    </div>
                </x-modal>
            </td>
        </tr>
        @endforeach
    </x-table>
@endsection
