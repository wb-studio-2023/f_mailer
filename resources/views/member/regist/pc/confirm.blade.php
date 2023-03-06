集客LP
<form action="{{ route('member.regist.execution') }}" method="POST">
    @csrf
    <input type="hidden" name="adress">
    <input type="hidden" name="password">
    <input type="submit" value="登録">
</form>
