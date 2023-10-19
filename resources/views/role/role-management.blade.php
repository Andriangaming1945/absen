@extends('main')

@section('slot')
<h3>{{ $title }}</h3>
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    <x-modal id="" label="Create Data" action="/role-managements" name="create">
        <div class="mb-3">
            <label for="create-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="create-name" name="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <label class="form-label">Permission</label>
            <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-12 col-lg-6">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="checkbox-{{ $permission->id }}-create">
                    <label class="form-check-label" for="checkbox-{{ $permission->id }}-create">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            </div>
        </div>
    </x-modal>
    <x-table :columns="['No', 'Name', 'Action']">
        @foreach ($roles as $role)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <button class="badge border-0 bg-primary" data-bs-toggle="modal" data-bs-target="#modal-show-{{ $role->id }}"><i class="fa-regular fa-eye"></i></button>
                <x-modal :id="$role->id" label="Show Data" action="" name="show">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $role->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permission</label>
                        <div class="row">
                        @foreach ($role->permissions as $permission)
                            <div class="col-12 col-lg-6">
                                <label class="form-check-label">
                                    <i class="fa-solid fa-square-check text-primary"></i> {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </x-modal>
                <button class="badge border-0 bg-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $role->id }}"><i class="fa-solid fa-pencil"></i></button>
                <x-modal :id="$role->id" label="Edit Data" name="edit" :action="'/role-managements/' . $role->id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="edit-name" value="{{ $role->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permission</label>
                        <div class="row">
                        @foreach ($role->permissions as $permission)
                            <div class="col-12 col-lg-6">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="checkbox-{{ $permission->id }}-edit" checked>
                                <label class="form-check-label" for="checkbox-{{ $permission->id }}-edit">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                        </div>

                        <div class="row">
                        @foreach ($permissions as $permission)
                            @if (($permission->roles[0]->id ?? 0) != $role->id)
                            <div class="col-12 col-lg-6">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="checkbox-{{ $permission->id }}-edit">
                                <label class="form-check-label" for="checkbox-{{ $permission->id }}-edit">
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </x-modal>
                <button class="badge border-0 bg-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $role->id }}"><i class="fa-solid fa-trash"></i></button>
                <x-modal :id="$role->id" label="Delete Data" name="delete" :action="'/role-managements/' . $role->id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $role->name }}" readonly>
                    </div>
                </x-modal>
            </td>
        </tr>
        @endforeach
    </x-table>
@endsection
