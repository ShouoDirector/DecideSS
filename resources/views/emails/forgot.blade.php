@component('mail::message')
{{-- Header --}}
# Password Recovery

Hello {{ $user->name }},

We understand forgetting passwords can be frustrating. No worries, we've got you covered!

{{-- Button --}}
@component('mail::button', ['url' => route('password.reset', ['token' => $user->remember_token]), 'color' => 'primary'])
Reset Your Password
@endcomponent

{{-- Instructions --}}
**To reset your password:**
1. Click the "Reset Your Password" button above.
2. Follow the instructions on the page to create a new password.
3. If you didn't request this, no action is needed; your password is still secure.

If you have any trouble resetting your password, please contact our support team at support@example.com.

Best regards,
The {{ config('app.name') }} Team

{{-- Footer --}}
@component('mail::subcopy')
If you’re having trouble clicking the "Reset Your Password" button, copy and paste the URL below into your web browser: [{{ route('password.reset', ['token' => $user->remember_token]) }}]({{ route('password.reset', ['token' => $user->remember_token]) }})
@endcomponent
@endcomponent
