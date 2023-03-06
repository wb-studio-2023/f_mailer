@extends('member.layout')
@section('title', 'シナリオ登録')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/scenario.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>シナリオ登録フォーム</h2>
    <form method="POST" action="{{ route('member.scenario.regist.confirm') }}" class="regist"  enctype="multipart/form-data">
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
            <tr>
                <th>アドレス</th>
                <td>
                    <input type="text" name="adress" value="{{ old('adress') }}">
                </td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>
                    <input type="text" name="title" value="{{ old('title') }}">
                </td>
            </tr>
            <tr>
                <th>タイトル<br>利用</th>
                <td>
                    <input type="radio" id="use" name="title_flg" value="0" @if (empty(old('title_flg'))) checked @endif>
                    <label for="use">利用する</label>
                    <input type="radio"  id="un_use"name="title_flg" value="1" @if (!empty(old('title_flg')) && config('const.SCENARIO.TITLE_FLG.ON') == old('title_flg')) checked @endif>
                    <label for="un_use">利用しない</label>
                </td>
            </tr>
        </table>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                確認画面へ
            </button>
        </div>
    </form>
</div>
@endsection