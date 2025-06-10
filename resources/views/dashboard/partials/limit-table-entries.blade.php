<form method="GET" id="limitTable" class="d-flex">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    @if (request('tag'))
        <input type="hidden" name="tag" value="{{ request('tag') }}">
    @endif
    @if (request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif
    <p class="align-self-center m-0">Show</p>
    <select 
      id="limit" 
      class="form-select mx-2"
      name="limit" 
      style="width: 4.5em" 
      onchange="document.getElementById('limitTable').submit();"
      aria-label="Select entries table"
    >
        @foreach([5, 10, 15, 25] as $option)
            <option value="{{ $option }}" {{ $limit == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    <p class="align-self-center m-0">entries</p>
</form>