@component('mail::message')
# {{ $message->subject }}

{{ $message->body }}

@if ($message->context)
---

**Context:** {{ class_basename($message->context_type) }} (ID: {{ $message->context_id }})

@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
