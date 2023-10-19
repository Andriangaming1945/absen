@extends('main')

@section('slot')
    <h3>{{ $title }}</h3>
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    <x-modal id="" label="Create Data" action="/user-managements" name="create">
        <div class="mb-3">
            <label for="no-id-name" class="form-label">No ID</label>
            <input type="text" class="form-control" id="no-id-name" name="no_id" placeholder="No ID">
        </div>
        <div class="mb-3">
            <label for="create-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="create-name" name="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="create-username" class="form-label">Username</label>
            <input type="number" class="form-control" id="create-username" name="username" placeholder="Ex: 11110000">
        </div>
        <div class="mb-3">
            <label for="create-phone" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="create-phone" name="phone" placeholder="Ex: 081">
        </div>
        <div class="mb-3">
            <label for="create-address" class="form-label">Address</label>
            <input type="text" class="form-control" id="create-address" name="address" placeholder="Jln..">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <x-select :selects="$roles" key="name" value="id" param="roles" selected="0" />
        </div>
        <div class="mb-3">
            <label for="create-employment-status" class="form-label">Status Pekerjaan</label>
            <input type="text" class="form-control" id="create-employment-status" name="employment_status"
                placeholder="Guru">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Tetap">Tetap</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="create-password" class="form-label">Password</label>
            <input type="password" class="form-control" id="create-password" name="password" placeholder="Password">
        </div>
    </x-modal>
    <x-table :columns="['No', 'Username', 'Name', 'Phone', 'Address', 'Employment Status', 'Action']">
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->employment_status }}</td>
                <td>
                    <button class="badge border-0 bg-warning" data-bs-toggle="modal"
                        data-bs-target="#modal-edit-{{ $user->id }}"><i class="fa-solid fa-pencil"></i></button>
                    <x-modal :id="$user->id" name="edit" label="Edit Data" :action="'/user-managements/' . $user->id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name"
                                value="{{ $user->name }}" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="edit-username" class="form-label">Username</label>
                            <input type="number" class="form-control" id="edit-username" name="username"
                                value="{{ $user->username }}" placeholder="Ex: 11110000">
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="edit-phone" name="phone"
                                value="{{ $user->username }}" placeholder="Ex: 081">
                        </div>
                        <div class="mb-3">
                            <label for="edit-address" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit-address" name="address"
                                value="{{ $user->username }}" placeholder="Jln..">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <x-select :selects="$roles" key="name" value="id" param="roles" :selected="(string) $user->roles[0]->id ?? 0" />
                        </div>
                        <div class="mb-3">
                            <label for="create-employment-status" class="form-label">Status Pekerjaan</label>
                            <input type="text" class="form-control" id="create-employment-status"
                                name="employment_status" placeholder="Guru">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                @if ($user->status == 'Tetap')
                                    <option value="Tetap" selected>Tetap</option>
                                @else
                                    <option value="Tetap">Tetap</option>
                                @endif
                                @if ($user->status == 'Full Time')
                                    <option value="Full Time" selected>Full Time</option>
                                @else
                                    <option value="Full Time">Full Time</option>
                                @endif
                                @if ($user->status == 'Part Time')
                                    <option value="Part Time" selected>Part Time</option>
                                @else
                                    <option value="Part Time">Part Time</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="edit-password" name="password"
                                placeholder="Password">
                        </div>
                    </x-modal>
                    <button class="badge border-0 bg-danger" data-bs-toggle="modal"
                        data-bs-target="#modal-delete-{{ $user->id }}"><i class="fa-solid fa-trash"></i></button>
                    <x-modal :id="$user->id" name="delete" label="Delete Data" :action="'/user-managements/' . $user->id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name"
                                value="{{ $user->name }}" readonly placeholder="Name">
                        </div>
                    </x-modal>
                </td>
            </tr>
        @endforeach
    </x-table>
@endsection
