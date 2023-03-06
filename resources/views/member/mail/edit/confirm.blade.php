@extends('member.layout')
@section('title', 'シナリオ編集確認ページ')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/mail.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>シナリオ編集確認ページ</h2>
    <form method="POST" action="{{ route('member.mail.edit.execution', ['scenario_id' => $scenarioData->id]) }}" class="edit"  enctype="multipart/form-data">
    @csrf
        <table class="edit_content">
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
            <tr>
                    <th>送信者名</th>
                    <td>
                        {{ $inputData['sender_name'] }}
                    </td>
                </tr>
                <input type="hidden" name="sender_name" value="{{ $inputData['sender_name'] }}">
                <tr>
                <tr>
                    <th>件名</th>
                    <td>
                        {{ $inputData['title'] }}
                    </td>
                </tr>
                <input type="hidden" name="title" value="{{ $inputData['title'] }}">
                <tr>
                <th>本文</th>
                    <td>
                        {!! nl2br(e($inputData['main'])) !!}
                    </td>
                    <input type="hidden" name="main" value="{{ $inputData['main'] }}">
                </tr>
                <tr>
                <th>配信予定時刻</th>
                <td>
                    {{ $inputData['send_year'] }}年&nbsp;
                    {{ $inputData['send_month'] }}月&nbsp;
                    {{ $inputData['send_day'] }}日&nbsp;&nbsp;
                    {{ $inputData['send_hour'] }}&nbsp;:&nbsp;
                    {{ $inputData['send_minute'] }}
                    <input type="hidden" name="send_year" value="{{ $inputData['send_year'] }}">
                    <input type="hidden" name="send_month" value="{{ $inputData['send_month'] }}">
                    <input type="hidden" name="send_day" value="{{ $inputData['send_day'] }}">
                    <input type="hidden" name="send_hour" value="{{ $inputData['send_hour'] }}">
                    <input type="hidden" name="send_minute" value="{{ $inputData['send_minute'] }}">
                </td>
            </tr>
            <tr>
                <th>執筆状況</th>
                <td>
                    {{ config('const.MAIL.STATUS.NAME.' . $inputData['status']) }}
                    <input type="hidden" name="status" value="{{ $inputData['status'] }}">
                </td>
            </tr>
        </table>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                登録
            </button>
            <button type="submit" name="action" value="back">
                戻る
            </button>
        </div>
        <input type="hidden" name="return" value="on">
        <input type="hidden" name="return_flg" value="on">
        <input type="hidden" name="kind_flg" value="edit">
        <input type="hidden" name="mail_id" value="{{ $inputData['mail_id'] }}">

    </form>
</div>
@endsection