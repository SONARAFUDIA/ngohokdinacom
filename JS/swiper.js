const swiperEl = document.querySelector('swiper-container');
          const swiper = swiperEl.swiper;
      
          document
            .querySelector(".prepend-2-slides")
            .addEventListener("click", function (e) {
              e.preventDefault();
              swiper.prependSlide([
                '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>",
                '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>",
              ]);
            });
          document
            .querySelector(".prepend-slide")
            .addEventListener("click", function (e) {
              e.preventDefault();
              swiper.prependSlide(
                '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>"
              );
            });