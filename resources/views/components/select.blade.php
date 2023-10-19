<select class="form-select" name="{{ $param }}">
    @foreach ($selects as $select)
        @if ($select->id == $selected)
            <option value="{{ $select[$value] }}" selected>{{ $select[$key] }}</option>
        @else
            <option value="{{ $select[$value] }}">{{ $select[$key] }}</option>
        @endif
    @endforeach
</select>
