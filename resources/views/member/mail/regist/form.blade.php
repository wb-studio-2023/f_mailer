@extends('member.layout')
@section('title', 'メール登録')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/mail.css') }}">
@endsection
@section('js')
    <script src="{{ mix('js/member/mail/main.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <h2>メール登録フォーム</h2>
    <form method="POST" action="{{ route('member.mail.regist.confirm', ['scenario_id' => $scenarioData->id]) }}" class="regist"  enctype="multipart/form-data">
    @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="validation">※{{ $error }}</p>
            @endforeach
        @endif
        <table class="regist_content">
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
            @if ($scenarioData->title_flg !== config('const.DATE.SCENARIO.TITLE_FLG.OFF'))
                <tr>
                    <th>送信者名</th>
                    <td>
                        <input type="text" name="sender_name" value="{{ old('sender_name') }}">
                    </td>
                </tr>
            @else
                <input type="hidden" name="sender_name" value="{{ $scenarioData->title }}">
            @endif
            <tr>
                <th>件名</th>
                <td>
                    <input type="text" name="title" value="{{ old('title') }}">
                </td>
            </tr>
            <tr>
                <th>本文</th>
                <td><textarea name="main">{{ old('main') }}</textarea></td>
            </tr>
            <tr>
                <th>配信予定時刻</th>
                <td>
                    <div class="send_date">
                        <select class="datetime year" name="send_year">
                            @foreach (config('const.DATE.YEAR') as $key => $year)
                                <option value="{{ $key }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="return_send_year" value="{{ old('send_year') }}">
                        年
                        <select class="datetime month" name="send_month">
                            @foreach (config('const.DATE.MONTH') as $key => $month)
                                <option value="{{ $key }}">{{ $month }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="return_send_month" value="{{ old('send_month') }}">
                        月
                        <select class="datetime day" name="send_day">
                            @foreach (config('const.DATE.YEAR') as $key => $year)
                                <option value="{{ $key }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="return_send_day" value="{{ old('send_day') }}">
                        日
                        <select class="datetime hour" name="send_hour">
                            @foreach(config('const.DATE.HOUR') as $key => $hour)
                                <option value="{{ $key }}">{{ $hour }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="return_send_hour" value="{{ old('send_hour') }}">
                        :
                        <select class="datetime minute" name="send_minute">
                            @foreach(config('const.DATE.MINUTE') as $key => $minute)
                                <option value="{{ $key }}">{{ $minute }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="return_send_minute" value="{{ old('send_minute') }}">
                    </div>
                </td>
            </tr>
            <tr>
                <th>執筆状況</th>
                <td>
                    <select name="status">
                        <option value="0">執筆中</option>
                        <option value="1" @if (!empty(old('return')) && old('return') == config('const.MAIL.STATUS.WAITING')) selected @endif>送信待ち</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                確認画面へ
            </button>
        </div>
        <input type="hidden" name="return" value="on">
        <input type="hidden" name="return_flg" value="{{ old('return') }}">
        <input type="hidden" name="kind_flg" value="regist">
    </form>
</div>
@endsection