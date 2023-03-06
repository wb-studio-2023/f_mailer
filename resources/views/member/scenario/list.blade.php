@extends('member.layout')
@section('title', 'シナリオ一覧')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/scenario.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>シナリオ一覧</h2>
    <div class="list_top_area">
        <a href="{{ route('member.scenario.regist.showForm') }}" class="regist_link">{{ __('新規作成') }}</a>
     </div>

    <div class="list_area">
        @if ($scenarioList->isNotEmpty())
            <form action="{{ route('member.scenario.delete.execution') }}" method="POST">
            @csrf
                <table class="list" border="1">
                    <colgroup>
                        <col style="width: 4%;">
                        <col style="width: 38%;">
                        <col style="width: 5%;">
                        <col style="width: 5%;">
                        <col style="width: 5%;">
                        <col style="width: 8%;">
                        <col style="width: 15%;">
                        <col style="width: 4%;">
                        <col style="width: 10%;">
                        <col style="width: 3%;">
                    </colgroup>
                    <thead>
                        <tr>
                        <th>
                                ID
                            </th>
                            <th>
                                タイトル
                            </th>
                            <th>
                                総メール数
                            </th>
                            <th>
                                予定メール数
                            </th>
                            <th>
                                アドレス数
                            </th>
                            <th>
                                登録日時
                            </th>
                            <th>
                                登録日時
                            </th>
                            <th>
                                編集
                            </th>
                            <th>
                                ステータス
                            </th>
                            <th>
                                削除
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scenarioList as $scenarioData)
                            <tr>
                                <td class="center">
                                    <a href="{{ route('member.mail.list', $scenarioData->id) }}">
                                        {{ $scenarioData->id }}
                                    </a>
                                </td>
                                <td>
                                    {{ $scenarioData->title }}
                                </td>
                                <td class="center">
                                    {{ $scenarioData->recipient_number ? $scenarioData->recipient_number : 0 }}
                                </td>
                                <td class="center">
                                    {{ $scenarioData->mail_number ? $scenarioData->mail_number : 0 }}
                                </td>
                                <td class="center">
                                    {{ $scenarioData->scheduled_mail_number ? $scenarioData->scheduled_mail_number : 0 }}
                                </td>
                                <td class="center">
                                    {{ Common::convertDatetime($scenarioData->updated_at) }}
                                </td>
                                <td class="center">
                                    <a href="{{ route('member.recipient.list', $scenarioData->id) }}">
                                        リスト管理
                                    </a>
                                    /
                                    <a href="{{ route('member.mail.list', $scenarioData->id) }}">
                                        メール管理
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="{{ route('member.scenario.edit.showForm', $scenarioData->id) }}">
                                        編集
                                    </a>
                                </td>
                                <td class="status center">
                                    <span class="status {{ config('const.SCENARIO.STATUS.CLASS.' . $scenarioData->status) }}">
                                        {{ config('const.SCENARIO.STATUS.NAME.' . $scenarioData->status) }}
                                    </span>
                                </td>
                                <td class="center">
                                    <input type="checkbox" value="{{ $scenarioData->id }}" name="delete_id[]">
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
        {{ $scenarioList->links('member.partical.pagination') }}
    </div>
</div>
@endsection