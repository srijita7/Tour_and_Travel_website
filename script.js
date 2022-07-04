let menu = document.querySelector("#menu-bar");
let navbar = document.querySelector(".header .navbar");
let videoBtn = document.querySelectorAll(".vid-btn");

window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
};

menu.addEventListener("click", () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
});

videoBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    document.querySelector(".controls .active").classList.remove("active");
    btn.classList.add("active");
    let src = btn.getAttribute("data-src");
    document.querySelector("#video-slider").src = src;
  });
});
var swiper = new Swiper(".review-slider", {
  spaceBetween: 20,
  loop: true,
  grabCursor: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".brand-slider", {
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    450: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    991: {
      slidesPerView: 4,
    },
    1200: {
      slidesPerView: 5,
    },
  },
})

function starsReducer(state, action) {
  switch (action.type) {
    case 'HOVER_STAR': {
      return {
        starsHover: action.value,
        starsSet: state.starsSet
      }
    }
    case 'CLICK_STAR': {
      return {
        starsHover: state.starsHover,
        starsSet: action.value
      }
    }
      break;
    default:
      return state
  }
}

var StarContainer = document.getElementById('rating');
var form = document.getElementById('review-form');
var StarComponents = StarContainer.children;

var state = {
  starsHover: 0,
  starsSet: 4
}

function render(value) {
  for (var i = 0; i < StarComponents.length; i++) {
    StarComponents[i].style.fill = i < value ? '#f4b5b6' : '#808080'
  }
}
for (var i = 0; i < StarComponents.length; i++) {
  StarComponents[i].addEventListener('mouseenter', function () {
    state = starsReducer(state, {
      type: 'HOVER_STAR',
      value: this.id
    })
    render(state.starsHover);
  })

  StarComponents[i].addEventListener('click', function () {
    state = starsReducer(state, {
      type: 'CLICK_STAR',
      value: this.id
    })
    render(state.starsHover);
    document.getElementById('finalRating').value = state.starsHover;
  })
}

StarContainer.addEventListener('mouseleave', function () {
  render(state.starsSet);
})

var review = document.getElementById('review');
var remaining = document.getElementById('remaining');
review.addEventListener('input', function (e) {
  review.value = (e.target.value.slice(0, 999));
  remaining.innerHTML = (999 - e.target.value.length);
})
/*
var form = document.getElementById("review-form")

form.addEventListener('submit', function (e) {
  e.preventDefault();
  let post = {
    stars: state.starsSet,
  }

  document.getElementById('finalRating').value = post.stars;
})*/
