<form method="GET">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    @if (request('tag'))
        <input type="hidden" name="tag" value="{{ request('tag') }}">
    @endif
    <div class="input-group">
        <input
          class="form-control"
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Search.."
          aria-label="Search Orders"
        />
        @if (request('limit'))
            <input type="hidden" name="limit" value="{{ request('limit') }}">
        @endif
        <button id="button-addon2" class="btn btn-icon btn-outline-primary" type="submit">
            <span class="material-symbols-rounded align-middle">search</span>
        </button>
    </div>
</form>