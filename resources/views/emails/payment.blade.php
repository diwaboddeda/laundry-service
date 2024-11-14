@component('mail::message')
# Item Successfully Picked Up

@component('mail::table')
|                  |                                                                                 |
| ---------------- | ------------------------------------------------------------------------------- | 
| Name             | {{$transaction->item->user->name}}                                              | 
| Service          | {{$transaction->service->name}}                                                 |
| Weight           | {{$transaction->item->weight}} Kg                                               |
| Total Payment    | Rp. {{ number_format($transaction->total_payment) }}                             |
| Received On      | {{ \Carbon\Carbon::parse($transaction->received_date)->format('d m Y, H:i') }}     |
| Picked Up On     | {{ \Carbon\Carbon::parse($transaction->pickup_at)->format('d m Y, H:i') }}       |
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
