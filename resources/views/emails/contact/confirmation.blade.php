@component('mail::message')
<div style="text-align: center; font-family: Inter, sans-serif; color: #111827;">
    <h1 style="font-size: 1.5rem; font-weight: 600;">Thank you for reaching out</h1>
    <p style="color: #374151;">
        We've received your message and will get back to you as soon as possible.
    </p>
    <p style="color: #374151;">
        If urgent, reply to this email.
    </p>
    <p style="font-size: 1.5rem;">🕊️</p>
    <p>— The Praise Story Team</p>
</div>

@slot('footer')
<div style="text-align: center; color: #6b7280; font-size: 0.875rem;">
    © {{ date('Y') }} Praise Story. All rights reserved.
    <a href="{{ url('/terms') }}" style="color: #6b7280;">T&C</a> •
    <a href="{{ url('/privacy') }}" style="color: #6b7280;">Privacy</a>
</div>
@endslot
@endcomponent
