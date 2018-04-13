@include('vendor.notifications.email', [
    'level' => 'notification',
    'actionUrl' => route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email),
    'introLines' => [trans('notifications.email.account-verify.reason'),],
    'actionText' => trans('notifications.email.account-verify.action'),
    'outroLines' => [trans('notifications.email.account-verify.explanation'),],
])
