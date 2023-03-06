@extends('member.layout')
@section('title', 'シナリオ登録確認ページ')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/scenario.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>シナリオ登録確認ページ</h2>
    <form method="POST" action="{{route('member.scenario.regist.execution')}}" class="regist"  enctype="multipart/form-data">
    @csrf
        <table class="regist_content">
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
            <tr>
            <tr>
                <th>アドレス</th>
                <td>
                    {{ $inputData['adress'] }}
                    <input type="hidden" value="{{ $inputData['adress'] }}" name="adress">
                </td>
            </tr>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>
                    {{ $inputData['title'] }}
                    <input type="hidden" value="{{ $inputData['title'] }}" name="title">
                </td>
            </tr>
            <tr>
                <th>タイトル利用</th>
                <td>
                    {{ $inputData['title_flg'] == 0 ? '利用する' : '利用しない' }}
                    <input type="hidden" value="{{ $inputData['title_flg'] }}" name="title_flg">
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
    </form>
</div>

@endsection