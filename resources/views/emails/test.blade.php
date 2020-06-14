@component('mail::message')

@if (!empty($user->name))
    {{ $user_name }} さん
@endif

----ご注文内容------------------------------

<h2>[受注番号]</h2>{{$order_id}}<br>
<h2>[日時]</h2>{{$date}}<br>
<h2>[注文者]</h2>{{$user_name}} 様<br>
<h2>[支払方法]</h2>{{$payway}}（前払）<br>

@endcomponent