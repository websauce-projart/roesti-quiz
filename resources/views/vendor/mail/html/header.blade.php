<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://pingouin.heig-vd.ch/websauce/img/logo_v2_1.svg" class="logo" alt="RöstiQuiz Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
