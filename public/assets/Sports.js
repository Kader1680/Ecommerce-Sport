


document.addEventListener("DOMContentLoaded", function() {
    // زر الشراء
    const shopBtn = document.querySelector(".shop-btn");
    shopBtn.addEventListener("click", function() {
        alert("Welcome to our store! Start shopping now.");
    });

    // تأثير تمرير الماوس على زر التسجيل
    const signupBtn = document.querySelector(".signup");
    signupBtn.addEventListener("mouseover", function() {
        signupBtn.style.backgroundColor = "#ff5733";
        signupBtn.style.color = "white";
    });

    signupBtn.addEventListener("mouseout", function() {
        signupBtn.style.backgroundColor = "transparent";
        signupBtn.style.color = "white";
    });
});



document.addEventListener("DOMContentLoaded", function() {
    const deals = document.querySelectorAll(".deal");

    deals.forEach(deal => {
        deal.addEventListener("mouseover", function() {
            this.style.background = "#ffebcc";
        });

        deal.addEventListener("mouseout", function() {
            this.style.background = "white";
        });
    });
});



document.querySelectorAll('.Questions-question').forEach(button => {
    button.addEventListener('click', () => {
      const answer = button.nextElementSibling;
      const isOpen = button.classList.contains('active');
  
      document.querySelectorAll('.Questions-question').forEach(btn => {
        btn.classList.remove('active');
        btn.nextElementSibling.style.display = 'none';
      });
  
      if (!isOpen) {
        button.classList.add('active');
        answer.style.display = 'block';
      }
    });
  });













const carousel = document.getElementById("carousel");
const dotsContainer = document.getElementById("dots");
const totalItems = document.querySelectorAll(".shop-card").length;
const visibleItems = Math.floor(window.innerWidth / 240);
const totalDots = Math.ceil(totalItems / visibleItems);

let isDragging = false;
let startX;
let scrollLeft;

// إنشاء النقاط
for (let i = 0; i < totalDots; i++) {
  const dot = document.createElement("span");
  dot.classList.add("dot");
  if (i === 0) dot.classList.add("active");
  dotsContainer.appendChild(dot);
}

const dots = document.querySelectorAll(".dot");

carousel.addEventListener("scroll", () => {
  const scrollIndex = Math.round(carousel.scrollLeft / (240 * visibleItems));
  dots.forEach(dot => dot.classList.remove("active"));
  if (dots[scrollIndex]) dots[scrollIndex].classList.add("active");
});

// دعم السحب بالماوس
carousel.addEventListener("mousedown", (e) => {
  isDragging = true;
  startX = e.pageX - carousel.offsetLeft;
  scrollLeft = carousel.scrollLeft;
}); 

carousel.addEventListener("mouseleave", () => isDragging = false);
carousel.addEventListener("mouseup", () => isDragging = false);

carousel.addEventListener("mousemove", (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const x = e.pageX - carousel.offsetLeft;
  const walk = (x - startX);
  carousel.scrollLeft = scrollLeft - walk;
});










