<x-mail::message>
<h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">
    Halo! Super CeritaKita,
</h1>

<p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
    Kami ingin memberitahukan bahwa ada permintaan reset password untuk akun pengguna berikut:
</p>
<hr>
<ul>
    <li>Nama Staff&emsp;&emsp;&emsp;&nbsp;: {{ $staffNama }}</li>
    <li>Username Staff&ensp;&ensp;&ensp;: {{ $staffUsername }}</li>
    <li>Email Staff &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;: {{ $staffEmail }}</li>
    <li>Tanggal & Waktu &nbsp;: {{ $tglRequest }}<br>Permintaan</li>
</ul>
<hr>
<p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
    Silakan tindak lanjuti permintaan ini jika diperlukan. Jika Anda merasa permintaan ini mencurigakan, harap lakukan pengecekan lebih lanjut. Terima kasih.
</p>

<x-mail::button :url="$url" color="primary">
Menu Staff Admin
</x-mail::button>

<p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
    Hormat kami,<br>
    Sistem {{ config('app.name') }}
</p>
</x-mail::message>
