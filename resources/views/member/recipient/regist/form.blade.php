@extends('member.layout')
@section('title', 'アドレス登録')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/recipient.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>アドレス登録フォーム</h2>
    <form method="POST" action="{{ route('member.recipient.regist.execution', ['scenario_id' => $request->scenario_id]) }}" class="regist"  enctype="multipart/form-data">
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
                登録
            </button>
        </div>
    </form>
</div>
@endsection