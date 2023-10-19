@extends('main')

@section('slot')
    <h3>{{ $title }}</h3>
    <div class="d-flex justify-content-between mb-5">
        <div>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-create">Import
                Data</button>
            <form action="/presences/export" method="get" class="d-inline">

                <input type="date" name="from_filter" hidden value="{{ request('from_filter') ?? null }}" class="form-control" required>
                <input type="date" name="until_filter" hidden value="{{ request('until_filter') ?? null }}" class="form-control" required>
                <button class="btn btn-sm btn-warning">Export
                    Data</button>
            </form>
            <x-modal id="" label="Create Data" action="/presences" name="create">
                <div class="mb-3">
                    <label for="create-presence" class="form-label">Excel Presence</label>
                    <input type="file" class="form-control" id="create-presence" name="presences">
                </div>
            </x-modal>
        </div>
        <div>
            <form action="/presences" method="get">
                <div class="d-flex gap-3 align-items-center">
                    <div>
                        Dari Tanggal :
                    <input type="date" name="from_filter" class="form-control" required>
                    </div>
                    <div>
                        Sampai Tanggal :
                    <input type="date" name="until_filter" class="form-control" required>
                    </div>
                    <button class="btn btn-success" style="height: fit-content">Filter</button>
                    <a href="/presences" class="btn btn-danger" style="height: fit-content">Clear</a>
                </div>
            </form>
        </div>
    </div>
    <x-table :columns="['No', 'Date', 'Name', 'Check In', 'Check Out', 'Action']">
        @foreach ($presences as $presence)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->user->name }}</td>
                <td>{{ $presence->check_in }}</td>
                <td>{{ $presence->check_out }}</td>
                <td>
                    -
                    {{-- <button class="badge border-0 bg-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $presence->id }}"><i class="fa-solid fa-pencil"></i></button>
                <x-modal :id="$presence->id" label="Edit Data" :action="'/presences/' . $presence->id" name="edit">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $presence->name }}" placeholder="Name">
                    </div>
                </x-modal>
                <button class="badge border-0 bg-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $presence->id }}"><i class="fa-solid fa-trash"></i></button>
                <x-modal :id="$presence->id" label="Delete Data" :action="'/presences/' . $presence->id" name="delete">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $presence->name }}" readonly placeholder="Name">
                    </div>
                </x-modal> --}}
                </td>
            </tr>
        @endforeach
    </x-table>
@endsection
