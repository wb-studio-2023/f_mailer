@extends('member.layout')
@section('title', 'アドレス配信解除')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/recipient.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>アドレス配信解除フォーム</h2>
    <form method="POST" action="{{ route('member.recipient.unsubscribe.execution', ['scenario_id' => $request->scenario_id]) }}" class="unsubscribe"  enctype="multipart/form-data">
    @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="validation">※{{ $error }}</p>
            @endforeach
        @endif
        <div class="recipient_textarea">
            <textarea name="adress" class="adress"></textarea>
        </div>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                配信解除
            </button>
        </div>
    </form>
</div>
@endsection