@if (session()->has('success'))
    @include('alerts.success')
@endif

@if (session()->has('error'))
    @include('alerts.error')
@endif

@if (session()->has('warning'))
    @include('alerts.warning')
@endif

@if (session()->has('info'))
    @include('alerts.info')
@endif