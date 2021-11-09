@component('mail::message')
# Booking {{ $orderTitle }} | {{ $orderTime }}

<br />
<strong>Personal:</strong> {{ $orderName }} <br />
<strong>Phone:</strong> {{ $orderPhone }} <br />
<hr />
<strong>Сhildren:</strong> {{ $orderChildren }}
<hr />
<strong>Liability:</strong> @if($orderLiability == '1') True @endif <br />
<strong>Screening:</strong> @if($orderScreening == '1') True @endif <br />
<strong>Waiver:</strong> @if($orderWaiver == '1') True @endif <br />
<strong>Release:</strong> @if($orderRelease == '1') True @endif <br />

Thanks,<br>
{{ config('app.name') }}
@endcomponent
