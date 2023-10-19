@extends('main')

@section('slot')
    <h3>{{ $title }}</h3>
    @can('create-permit')
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    @endcan
    <x-modal id="" label="Create Data" action="/permits" name="create">
        <div class="mb-3">
            <label for="create-date" class="form-label">Date</label>
            <input type="date" class="form-control" id="create-date" name="date"
                value="{{ now()->isoFormat('YYYY-MM-DD') }}" readonly>
        </div>
        <div class="mb-3">
            <label for="create-file" class="form-label">Upload Surat Perizinan</label>
            <input type="file" class="form-control" id="create-file" name="permit_document">
        </div>
        @hasanyrole('Guru Full Time|Guru Part Time')
            <div class="mb-3">
                <label for="create-file" class="form-label">Upload Tugas</label>
                <input type="file" class="form-control" id="create-file" name="classroom_document">
            </div>
        @endhasanyrole
        <div class="mb-3">
            <label for="create-information" class="form-label">Information</label>
            <select type="file" class="form-control" id="create-information" name="information_permit_id">
                @foreach ($information_permits as $information)
                    <option value="{{ $information->id }}">{{ $information->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="pesan" class="form-label">Keterangan  </label>
            <textarea name="Pesan" id="Pesan" cols="50" rows="5" placeholder="Masukkan keterangan anda"></textarea>
        </div>

    </x-modal>
    @php
        $columns = Auth::user()->hasRole('Guru Full Time') || Auth::user()->hasRole('Guru Part Time') || Auth::user()->hasRole('Wakasek') ? ['No', 'Name', 'Date', 'Information', 'Perizinan Document', 'Tugas Document', 'Status', 'Action']
                    : ['No', 'Name', 'Date', 'Information', 'Permit Document', 'Status', 'Action']
    @endphp
    <x-table :columns="$columns">
        @foreach ($permits as $permit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $permit->user->name }}</td>
                <td>{{ $permit->date }}</td>
                <td>{{ $permit->information_permit->name }}</td>
                <td>
                    <a
                        href="/download?file={{ $permit->permit_document }}&data={{ $permit->user->name }} Izin {{ $permit->date }}"><i
                            class="fa-solid fa-download"></i></a>
                </td>
                @hasanyrole('Guru Full Time|Guru Part Time|Wakasek')
                <td>
                    @if ($permit->classroom_document)
                    <a
                    href="/download?file={{ $permit->classroom_document }}&data={{ $permit->user->name }} Tugas Document {{ $permit->date }}"><i
                        class="fa-solid fa-download"></i></a>
                    @else
                    -
                    @endif
                </td>
                @endhasanyrole
                <td>
                    @if ($permit->status_permit == 'Pending')
                        <div class="badge bg-warning">{{ $permit->status_permit }}</div>
                    @else
                        <div class="badge bg-success">{{ $permit->status_permit }}</div>
                    @endif
                </td>
                <td>

                    @if ($permit->status_permit == 'Pending')
                        @can('approve-permit')
                            <form action="/approve-permit/{{ $permit->id }}" method="post">
                                @csrf
                                @method('put')
                                <button class="badge border-0 bg-success"><i class="fa-solid fa-check"></i></button>
                            </form>
                        @endcan
                        @can('update-permit')
                            <button class="badge border-0 bg-warning" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-{{ $permit->id }}"><i class="fa-solid fa-pencil"></i></button>
                            <x-modal :id="$permit->id" label="Edit Data" :action="'/permits/' . $permit->id" name="edit">
                                <div class="mb-3">
                                    <label for="create-date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="create-date" name="date"
                                        value="{{ $permit->date }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="create-file" class="form-label">Upload Surat Perizinan</label>
                                    <input type="file" class="form-control" id="create-file" name="permit_document"
                                        value="{{ $permit->permit_document }}">
                                </div>
                                @hasanyrole('Guru Full Time|Guru Part Time')
                                    <div class="mb-3">
                                        <label for="create-file" class="form-label">Upload Tugas</label>
                                        <input type="file" class="form-control" id="create-file" name="classroom_document"
                                            value="{{ $permit->classroom_document }}">
                                    </div>
                                @endhasanyrole
                                <div class="mb-3">
                                    <label for="create-information" class="form-label">Information</label>
                                    <select type="file" class="form-control" id="create-information"
                                        name="information_permit_id">
                                        @foreach ($information_permits as $information)
                                            @if ($information->id == $permit->information_permit->id)
                                                <option value="{{ $information->id }}" selected>{{ $information->name }}
                                                </option>
                                            @else
                                                <option value="{{ $information->id }}">{{ $information->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="pesan" class="form-label">Keterangan  </label>
                                    <textarea name="Pesan" id="Pesan" cols="50" rows="5" placeholder="Masukkan keterangan anda"></textarea>
                                </div>
                            </x-modal>
                        @endcan

                        @can('delete-permit')
                            <button class="badge border-0 bg-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-delete-{{ $permit->id }}"><i class="fa-solid fa-trash"></i></button>
                            <x-modal :id="$permit->id" label="Delete Data" :action="'/permits/' . $permit->id" name="delete">
                                <div class="mb-3">
                                    <label for="create-date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="create-date" name="date"
                                        value="{{ $permit->date }}" readonly>
                                </div>
                            </x-modal>
                        @endcan
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </x-table>
@endsection
