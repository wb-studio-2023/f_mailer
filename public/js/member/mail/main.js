$(function () {
  //公開・非公開時間
  // 初期表示
  var returnFlg = $("input[name=return_flg]").val(),
    kindFlg = $("input[name=kind_flg]").val();

  //公開開始時刻
  if (returnFlg == 'on' || kindFlg == 'edit') {
    var setSendYear = $("input[name=return_send_year]").val();
    var setSendMonth = Number($("input[name=return_send_month]").val());
    var setSendDate = Number($("input[name=return_send_day]").val());
    var setSendHours = Number($("input[name=return_send_hour]").val());
    var setSendMinute = Number($("input[name=return_send_minute]").val());
    console.log("aaaaaaaaaaaaaaaaaaaaaaaddddddddddddddddddddd");
  } else {
    var current = new Date();
    var setSendYear = current.getFullYear();
    var setSendMonth = current.getMonth() + 1;
    var setSendDate = current.getDate();
    var setSendHours = current.getHours();
    var setSendMinute = current.getMinutes();
    console.log("111111111111111111111111111111");
  }
  //公開開始時間SET
  $('select[name=send_year] option[value=' + setSendYear + ']').prop('selected', true);
  $('select[name=send_month] option[value=' + setSendMonth + ']').prop('selected', true);
  $('select[name=send_hour] option[value=' + setSendHours + ']').prop('selected', true);
  $('select[name=send_minute] option[value=' + setSendMinute + ']').prop('selected', true);
  setSendDay();
  $('select[name=send_day] option[value=' + setSendDate + ']').prop('selected', true);
  // 年/月 変更--公開開始
  $('select[name=send_year], select[name=send_month]').change(function () {
    setSendeleaseDay();
  });
});

/**
 * 日プルダウンの制御
 */
function setSendDay() {
  yearVal = $('select[name=send_year]').val();
  monthVal = $('select[name=send_month]').val();

  // 指定月の末日
  var t = 31;
  // 2月
  if (monthVal == 2) {
    //　4で割りきれる且つ100で割りきれない年、または400で割り切れる年は閏年
    if (Math.floor(yearVal % 4) == 0 && Math.floor(yearVal % 100) != 0 || Math.floor(yearVal % 400) == 0) {
      t = 29;
    } else {
      t = 28;
    }
    // 4,6,9,11月
  } else if (monthVal == 4 || monthVal == 6 || monthVal == 9 || monthVal == 11) {
    t = 30;
  }

  // 初期化
  $('select[name=send_day] option').remove();
  for (var i = 1; i <= t; i++) {
    $('select[name=send_day]').append('<option value="' + i + '">' + i + '</option>');
  }
}
