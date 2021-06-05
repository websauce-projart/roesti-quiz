<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.imgur.com/ZccTVwN.png" class="logo" alt="RöstiQuiz Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
