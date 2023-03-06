@extends('member.layout')
@section('title', 'シナリオ編集')
@section('css')
    <link rel="stylesheet" href="{{ mix('css/member/scenario.css') }}">
@endsection
@section('js')
@endsection

@section('content')
<div class="container">
    <h2>シナリオ編集フォーム</h2>
    <form method="POST" action="{{ route('member.scenario.edit.confirm') }}" class="edit"  enctype="multipart/form-data">
    @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="validation">※{{ $error }}</p>
            @endforeach
        @endif
        <table class="edit_content">
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
            <tr>
                <th>アドレス</th>
                <td>
                    <input type="text" name="adress" value="@if (!empty(old('adress'))){{ old('adress') }}@else{{ $scenarioData->adress }}@endif">
                </td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>
                    <input type="text" name="title" value="@if (!empty(old('title'))){{ old('title') }}@else{{ $scenarioData->title }}@endif">
                </td>
            </tr>
            <tr>
                <th>タイトル<br>利用</th>
                <td>
                    <input type="radio" id="use" name="title_flg" value="0" @if ((!empty(old('return_flg')) && old('return_flg') == config('const.SCENARIO.RETURN_FLG.ON') ) && empty(old('title_flg'))) checked @elseif (empty(old('return_flg')) && empty($scenarioData->title_flg))) checked @endif>
                    <label for="use">利用する</label>
                    <input type="radio"  id="un_use"name="title_flg" value="1" @if ((!empty(old('return_flg')) && old('return_flg') == config('const.SCENARIO.RETURN_FLG.ON') ) && !empty(old('title_flg'))) checked @elseif (empty(old('return_flg')) && !empty($scenarioData->title_flg))) checked @endif>
                    <label for="un_use">利用しない</label>
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
        <input type="hidden" name="scenario_id" value="{{ $scenarioData->id }}">
    </form>
</div>
@endsection