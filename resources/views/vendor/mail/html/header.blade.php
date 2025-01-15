@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
        @if (trim($slot) === 'CeritaKita')
            <img src="{{ config('app.url') }}/favicon.ico" class="logo" alt="{{ config('app.name') }}">
        @else
            {{ $slot }}
        @endif
        </a>
    </td>
</tr>
