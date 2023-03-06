@extends('member.layout')
@section('title', 'メール一覧')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/mail.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>メール一覧</h2>
    <div class="list_top_area">
        <div class="link_area">
            <a href="{{ route('member.mail.regist.showForm', ['scenario_id' => $arrayRequest['scenario_id']]) }}" class="regist_link">{{ __('新規作成') }}</a>
        </div>
    </div>

    <div class="list_area">
        <form action="{{ route('member.mail.search', ['scenario_id' => $arrayRequest['scenario_id']]) }}" method="POST" class="search">
            @csrf
            <input type="text" name="keyword" value="{{ $arrayRequest['keyword'] }}">
            <input type="submit" value="検索">
        </form>
        @if ($mailList->isNotEmpty())
            <form action="{{ route('member.mail.delete.execution', ['scenario_id' => $arrayRequest['scenario_id']]) }}" method="POST">
            @csrf
                <table class="list" border="1">
                    <colgroup>
                        <col style="width: 9%;">
                        <col style="width: 10%;">
                        <col style="width: 58%;">
                        <col style="width: 9%;">
                        <col style="width: 10%;">
                        <col style="width: 4%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                ステータス
                            </th>
                            <th>
                                タイトル
                            </th>
                            <th>
                                アドレス数
                            </th>
                            <th>
                                送信時間
                            </th>
                            <th>
                                削除
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mailList as $mailData)
                            <tr>
                                <td class="center">
                                    <a href="{{ route('member.mail.edit.showForm', ['scenario_id' => $mailData->scenario_id, 'mail_id' => $mailData->id]) }}">
                                        {{ $mailData->id }}
                                    </a>
                                </td>
                                <td class="status center">
                                    <span class="status {{ config('const.MAIL.STATUS.CLASS.' . $mailData->status) }}">
                                        {{ config('const.MAIL.STATUS.NAME.' . $mailData->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $mailData->title }}
                                </td>
                                <td class="center">
                                    {{ $mailData->recipient_number ? $mailData->recipient_number : 0 }}
                                </td>
                                <td class="center">
                                    {{ Common::convertDatetime($mailData->send_at) }}
                                </td>
                                <td class="center">
                                    <input type="checkbox" value="{{ $mailData->id }}" name="delete_id[]">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="button_area">
                    <button type="submit" id="delete">checkしたものを消す</button>
                </div>
            </form>
        @else
            シナリオが一つも登録されていません。
        @endif
    </div>
    <div id="pagination">
        {{ $mailList->links('member.partical.pagination') }}
    </div>
</div>
@endsection