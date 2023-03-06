$(function () {
  var mySwiper = new Swiper('.swiper', {
    slidesPerView: 2,
    // ページネーションが必要なら追加
    pagination: {
      el: ".swiper-pagination"
    },
    // ナビボタンが必要なら追加
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
});
