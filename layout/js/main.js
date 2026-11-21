/*==================================
  change the theme 
  ==================================*/

const themeToggler = document.querySelector(".theme-toggler");
// start with dark theme
// document.body.classList.toggle("dark-them-variables");

if (themeToggler) {
  // change the theme
  themeToggler.addEventListener("click", () => {
    document.body.classList.toggle("dark-them-variables");

    themeToggler.querySelector("i:nth-child(1)").classList.toggle("active");
    themeToggler.querySelector("i:nth-child(2)").classList.toggle("active");
  });
}

/*==================================
  Sidebar in mobile and small tablet 
  ==================================*/

const sideMenu = document.querySelectorAll("aside .navigation ul.sidebar li");
sideMenu.forEach((item) => item.addEventListener("click", activeLink));

function activeLink() {
  sideMenu.forEach((item) => item.classList.remove("active"));
  this.classList.add("active");
}

/*==================================
    show and hide Sidebar
    ==================================*/

const toggleSidebar = document.querySelector(".sidebar .toggle-sidebar");
const logo = document.querySelector(".sidebar .logo-box");
const sidebar = document.querySelector(".sidebar");

if (toggleSidebar && logo) {
  toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });

  logo.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
}

/*==================================
    Sidebar in other pages
    ==================================*/

const listItems = document.querySelectorAll(".sidebar-list li");

listItems.forEach((item) => {
  item.addEventListener("click", () => {
    let isActive = item.classList.contains("active");

    listItems.forEach((el) => {
      el.classList.remove("active");
    });

    if (isActive) item.classList.remove("active");
    else item.classList.add("active");
  });
});

/*==================================
  slider card
    ==================================*/
var swiper = new Swiper(".slide-content", {
  slidesPerView: 3,
  spaceBetween: 25,
  loop: false,
  centerSlide: "true",
  fade: "true",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 3,
    },
  },
});

function get_price() {
  let totalPrice = 0;
  let products = document.querySelectorAll(".card-table tbody tr");
  let price_total = document.querySelector(".title-date .date .price");

  // console.log("hi");
  products.forEach((e) => {
    let price = e.getAttribute("price");
    let value = e.children[4].children[0].value;
    let total = 0;
    if (value > 0) {
      total = price * value;
      totalPrice += total;
    }
    e.children[5].children[0].textContent = parseInt(total);
  });

  price_total.textContent = parseInt(totalPrice);
}

if ($(".title-date .date .price").val() == "") {
  get_price();
}

/*==================================
      notification alert
    ==================================*/

function notify(flag_success, massage = "تبيه بإجراء عملية ") {
  $(".toast").addClass("active");
  $(".text-massage").text(massage);

  if (flag_success === "success") {
    $(".toast").addClass("success");
    $(".check").addClass("fa-check");
    //
    // alert text
    $(".text-title").text("تم");
  } else if (flag_success === "danger") {
    $(".toast").addClass("danger");
    $(".check").addClass("fa-close");
    //
    // alert text
    $(".text-title").text("خطأ");
  } else if (flag_success === "warning") {
    $(".toast").addClass("warning");
    $(".check").addClass("fa-warning");
    //
    // alert text
    $(".text-title").text("تحذير");
  }

  setTimeout(() => {
    $(".toast").removeClass("active success danger warning");
  }, 2100);

  $(".close").click(function () {
    setTimeout(() => {
      $(this).parent(".toast").removeClass("active success danger warning");
    }, 10);
  });
}

/*==================================
  JQuery Functions
  ==================================*/

$(document).ready(function () {
  ("use strict");

  $(".card-table tbody tr td.price input.quantity").change(function () {
    get_price();
  });
  /*================================
    login form
    ==================================*/

  $(".form-gp input").on("focus", function () {
    $(this).parent(".form-gp").addClass("focused");
  });

  $(".form-gp input").on("focusout", function () {
    if ($(this).val().length === 0) {
      $(this).parent(".form-gp").removeClass("focused");
    }
  });

  /*================================
    Search Animation
    ==================================*/
  $(".search i").click(function () {
    $(this).parent(".search").toggleClass("active");

    if ($(this).hasClass("fa-search")) {
      $(this).removeClass("fa-search search").addClass("fa-close close");
    } else {
      $(this).removeClass("fa-close close").addClass("fa-search search");
    }
  });
  /*================================
    live preview form
    ==================================*/

  $(".live").keyup(function () {
    if ($(this).val() !== "") $($(this).data("class")).text($(this).val());
    else $($(this).data("class")).text($($(this).data("class")).attr("text"));
  });

  $(".form-check-input[type='checkbox']").on("change", function () {
    if ($(this).checked) {
      $(this).val("1");
    } else {
      $(this).val("0");
    }
  });

  $("input[type='file'].live").on("change", function () {
    $($(this).data("class")).attr("src", $(this)[0].files[0].name);
    // console.log($(this)[0].files[0].name);
  });

  /*================================
    DataTable Bootstrap
    ==================================*/
  $(".data_table").DataTable();

  let filter = document.querySelector(".dataTables_filter label");

  if (filter) filter.childNodes[0].textContent = " بحث :";

  let label1_length = document.querySelector(".dataTables_length label");
  if (label1_length) label1_length.childNodes[0].textContent = " عدد العناصر :";

  let label2_length = document.querySelector(".dataTables_length label");
  if (label2_length) label2_length.childNodes[2].textContent = "";

  /*================================
    CheckBox value
    ==================================*/
  $(".form-check-input[type='checkbox']").on("change", function () {
    if ($(this).checked) {
      $(this).val("1");
    } else {
      $(this).val("0");
    }
  });

  //
  //
  /*==================================
    Preloader
    ==================================*/
  $(".preloader").fadeOut();
});
