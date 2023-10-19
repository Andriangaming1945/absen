@extends('main')

@section('slot')
<h3>{{ $title }}</h3>
    @can('create-task')
    <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal-create">Create Data</button>
    <x-modal id="" label="Create Data" action="/tasks" name="create">
        <div class="mb-3">
            <label for="create-date" class="form-label">Date</label>
            <input type="date" class="form-control" id="create-date" name="date" value="{{ now()->isoFormat('YYYY-MM-DD') }}" readonly>
        </div>
        <div class="mb-3">
            <label for="create-file" class="form-label">File Task</label>
            <input type="file" class="form-control" id="create-file" name="task_document">
        </div>
        <div class="mb-3">
            <label class="form-label">Classroom</label>
            <div class="row">
            @foreach ($classrooms as $classroom)
                <div class="col-12 col-lg-6">
                    <input class="form-check-input" type="checkbox" name="classrooms[]" value="{{ $classroom->id }}" id="checkbox-{{ $classroom->id }}-create">
                    <label class="form-check-label" for="checkbox-{{ $classroom->id }}-create">
                        {{ $classroom->name }}
                    </label>
                </div>
            @endforeach
            </div>
        </div>
    </x-modal>
    @endcan
    <x-table :columns="['No', 'Name', 'Date', 'Download File', 'Action']">
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->user->name }}</td>
            <td>{{ $task->date }}</td>
            <td>
                <a href="/download?file={{ $task->task_document }}&data={{ $task->user->name }} Task {{ $task->date }}"><i class="fa-solid fa-download"></i></a>
            </td>
            <td>
                <button class="badge border-0 bg-primary" data-bs-toggle="modal" data-bs-target="#modal-show-{{ $task->id }}"><i class="fa-regular fa-eye"></i></button>
                <x-modal :id="$task->id" label="Show Data" action="" name="show">
                    <div class="mb-3">
                        <label for="show-date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="show-date" name="date" value="{{ $task->date }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Classroom</label>
                        <div class="row">
                        @foreach ($task->task_classroom as $classroom)
                            <div class="col-12 col-lg-6">
                                <label class="form-check-label">
                                    <i class="fa-solid fa-square-check text-primary"></i> {{ $classroom->classroom->name }}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </x-modal>
                @can('update-task')
                `<button class="badge border-0 bg-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $task->id }}"><i class="fa-solid fa-pencil"></i></button>
                <x-modal :id="$task->id" label="Edit Data" name="edit" :action="'/tasks/' . $task->id">
                    <div class="mb-3">
                        <label for="edit-date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="edit-date" name="date" value="{{ $task->date }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-file" class="form-label">File Task</label>
                        <input type="file" class="form-control" value="{{ $task->task_document }}" id="edit-file" name="task_document">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Classroom</label>
                        <div class="row">
                        @foreach ($task->task_classroom as $classroom)
                            <div class="col-12 col-lg-6">
                                <input class="form-check-input" type="checkbox" name="classrooms[]" value="{{ $classroom->classroom->id }}" id="checkbox-{{ $classroom->classroom->id }}-edit" checked>
                                <label class="form-check-label" for="checkbox-{{ $classroom->classroom->id }}-edit">
                                    {{ $classroom->classroom->name }}
                                </label>
                            </div>
                        @endforeach
                        </div>

                        <div class="row">
                            @foreach (HelperTask::filterClassroom($task->task_classroom) as $classroom)
                                    <div class="col-12 col-lg-6">
                                        <input class="form-check-input" type="checkbox" name="classrooms[]" value="{{ $classroom->id }}" id="checkbox-{{ $classroom->id }}-edit">
                                        <label class="form-check-label" for="checkbox-{{ $classroom->id }}-edit">
                                            {{ $classroom->name }}
                                        </label>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </x-modal>
                @endcan
                @can('delete-task')
                <button class="badge border-0 bg-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $task->id }}"><i class="fa-solid fa-trash"></i></button>
                <x-modal :id="$task->id" label="Delete Data" :action="'/tasks/' . $task->id" name="delete">
                    <div class="mb-3">
                        <label for="delete-name" class="form-label">Date</label>
                        <input type="date" class="form-control" id="delete-name" name="date" value="{{ $task->date }}" readonly>
                    </div>
                </x-modal>
                @endcan
            </td>
        </tr>
        @endforeach
    </x-table>
@endsection
