  document.addEventListener('DOMContentLoaded', () => {
      const track = document.querySelector('.index-slider-track');
      const slides = document.querySelectorAll('.index-slide');
      const dots = document.querySelectorAll('.nav-dot');
      const prevBtn = document.querySelector('.prev-btn');
      const nextBtn = document.querySelector('.next-btn');
      const progressBar = document.querySelector('.index-progress-bar');
      let currentIndex = 0;
      let autoPlayInterval;
      const autoPlayDelay = 6000;
      let startX, moveX;
      const swipeThreshold = 50;

      function updateSlide() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === currentIndex);
        });
        dots.forEach((dot, i) => {
          dot.classList.toggle('active', i === currentIndex);
        });
        animateProgressBar();
      }

      function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlide();
      }

      function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlide();
      }

      function goToSlide(index) {
        currentIndex = index;
        updateSlide();
      }

      function startAutoPlay() {
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
      }

      function pauseAutoPlay() {
        clearInterval(autoPlayInterval);
      }

      function animateProgressBar() {
        progressBar.style.width = '0%';
        progressBar.style.transition = 'none';
        void progressBar.offsetWidth;
        progressBar.style.transition = `width ${autoPlayDelay / 1000}s linear`;
        progressBar.style.width = '100%';
      }

      function handleTouchStart(e) {
        startX = e.touches[0].clientX;
      }

      function handleTouchMove(e) {
        if (!startX) return;
        moveX = e.touches[0].clientX;
      }

      function handleTouchEnd() {
        if (!startX || !moveX) return;
        const diffX = startX - moveX;
        if (diffX > swipeThreshold) {
          pauseAutoPlay();
          nextSlide();
          startAutoPlay();
        } else if (diffX < -swipeThreshold) {
          pauseAutoPlay();
          prevSlide();
          startAutoPlay();
        }
        startX = null;
        moveX = null;
      }

      track.addEventListener('touchstart', handleTouchStart, { passive: true });
      track.addEventListener('touchmove', handleTouchMove, { passive: true });
      track.addEventListener('touchend', handleTouchEnd, { passive: true });

      nextBtn.addEventListener('click', () => {
        pauseAutoPlay();
        nextSlide();
        startAutoPlay();
      });

      prevBtn.addEventListener('click', () => {
        pauseAutoPlay();
        prevSlide();
        startAutoPlay();
      });

      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          pauseAutoPlay();
          goToSlide(index);
          startAutoPlay();
        });
      });

      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
          pauseAutoPlay();
          nextSlide();
          startAutoPlay();
        } else if (e.key === 'ArrowLeft') {
          pauseAutoPlay();
          prevSlide();
          startAutoPlay();
        }
      });

      const slider = document.getElementById('slider');
      slider.addEventListener('mouseenter', pauseAutoPlay);
      slider.addEventListener('mouseleave', startAutoPlay);

      updateSlide();
      animateProgressBar();
      setTimeout(() => {
        nextSlide();
        startAutoPlay();
      }, 6000);
    });
