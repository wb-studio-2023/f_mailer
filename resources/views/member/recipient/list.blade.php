@extends('member.layout')
@section('title', 'アドレスリスト一覧')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/recipient.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>アドレスリスト一覧</h2>
    <div class="list_top_area">
        <div class="link_area">
            <a href="{{ route('member.recipient.regist.showForm', ['scenario_id' => $arrayRequest['scenario_id']]) }}">アドレス登録</a>
            <a href="{{ route('member.recipient.unsubscribe.showForm', ['scenario_id' => $arrayRequest['scenario_id']]) }}">配信解除</a>
        </div>
     </div>

    <div class="list_area">
        <form action="{{ route('member.recipient.search', ['scenario_id' => $arrayRequest['scenario_id']]) }}" method="POST" class="search">
            @csrf
            <input type="text" name="keyword" value="{{ $arrayRequest['keyword'] }}">
            <input type="radio" name="status" id="sendable" value="{{ config('const.RECIPIENT.STATUS.SENDABLE') }}" @if ($arrayRequest['status'] == config('const.RECIPIENT.STATUS.SENDABLE') && $arrayRequest['status'] !== NULL) checked @endif>
            <label for="sendable">配信可能</label>
            <input type="radio" name="status" id="unsendable" value="{{ config('const.RECIPIENT.STATUS.UNSENDABLE') }}" @if (!empty($arrayRequest['status']) && $arrayRequest['status'] == config('const.RECIPIENT.STATUS.UNSENDABLE')) checked @endif>
            <label for="unsendable">配信停止</label>
            <input type="submit" value="検索">
        </form>
        @if ($recipientList->isNotEmpty())
            <form action="{{ route('member.recipient.delete.execution', ['scenario_id' => $arrayRequest['scenario_id']]) }}" method="POST">
            @csrf
                <table class="list" border="1">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 50%;">
                        <col style="width: 20%;">
                        <col style="width: 10%;">
                        <col style="width: 7%;">
                        <col style="width: 3%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                アドレス数
                            </th>
                            <th>
                                名前
                            </th>
                            <th>
                                更新日時
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
                        @foreach ($recipientList as $recipientData)
                            <tr>
                                <td class="center">
                                    {{ $recipientData->id }}
                                </td>
                                <td>
                                    {{ $recipientData->adress }}
                                </td>
                                <td>
                                    {{ $recipientData->name }}
                                </td>
                                <td class="center">
                                    {{ Common::convertDatetime($recipientData->updated_at) }}
                                </td>
                                <td class="status center">
                                    <span class="status {{ config('const.RECIPIENT.STATUS.CLASS.' . $recipientData->status) }}">
                                        {{ config('const.RECIPIENT.STATUS.NAME.' . $recipientData->status) }}
                                    </span>
                                </td>
                                <td class="center">
                                    <input type="checkbox" value="{{ $recipientData->id }}" name="delete_id[]">
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
        {{ $recipientList->links('member.partical.pagination') }}
    </div>
</div>
@endsection