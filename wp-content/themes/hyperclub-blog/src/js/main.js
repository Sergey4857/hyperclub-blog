//burger menu
jQuery(document).ready(function ($) {
  $(".burger-button").on("click", function (event) {
    event.stopPropagation(); 
    $(this).toggleClass("active");
    $(".burger-nav-wrap").toggleClass("active");
    $(".burger-backdrop").toggleClass("active");
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest(".burger-nav-wrap, .burger-button").length) {
      $(".burger-button, .burger-nav-wrap, .burger-backdrop").removeClass("active");
    }
  });

  $('.burger-title').on('click', function () {
    $('.burger-block').not($(this).next('.burger-block')).slideUp(300);
    $('.burger-title').not(this).removeClass('active');

    $(this).next('.burger-block').slideToggle(300);
    $(this).toggleClass('active');
  });

  $('.burger-block').slideUp(0);
});


document.addEventListener("DOMContentLoaded", () => {
  //custom blog dropdown
  const dropdownButton = document.querySelector(".dropdown-button");
  const dropdownMenu = document.querySelector(".dropdown-menu");
  const hiddenCategoryInput = document.getElementById("hiddenCategoryInput");
  const searchInput = document.getElementById("searchInput");

  const urlParams = new URLSearchParams(window.location.search);
  const selectedCategory = urlParams.get("category") || "";
  const searchQuery = urlParams.get("s") || "";

  if (
    selectedCategory &&
    dropdownButton &&
    dropdownMenu &&
    hiddenCategoryInput
  ) {
    const selectedItem = Array.from(dropdownMenu.children).find(
      (item) => item.getAttribute("data-value") === selectedCategory
    );
    if (selectedItem) {
      dropdownButton.textContent = selectedItem.textContent;
    }
    hiddenCategoryInput.value = selectedCategory;
  } else if (dropdownButton) {
    dropdownButton.textContent = "All Categories";
  }

  if (searchQuery && searchInput) {
    searchInput.value = searchQuery;
  }

  if (dropdownButton && dropdownMenu) {
    dropdownButton.addEventListener("click", (event) => {
      event.stopPropagation();
      dropdownMenu.classList.toggle("show");
      dropdownButton.classList.toggle("show");
    });

    dropdownMenu.addEventListener("click", (event) => {
      if (event.target.classList.contains("dropdown-item")) {
        const selectedCategoryValue = event.target.getAttribute("data-value");
        dropdownButton.textContent = event.target.textContent;
        if (hiddenCategoryInput) {
          hiddenCategoryInput.value = selectedCategoryValue;
        }
        dropdownMenu.classList.remove("show");
        dropdownButton.classList.remove("show");
      }
    });

    document.addEventListener("click", (event) => {
      if (
        dropdownButton &&
        dropdownMenu &&
        !dropdownButton.contains(event.target) &&
        !dropdownMenu.contains(event.target)
      ) {
        dropdownMenu.classList.remove("show");
        dropdownButton.classList.remove("show");
      }
    });
  }

  //hover class image post and h2
  document.querySelectorAll(".post-item").forEach((postItem) => {
    const image = postItem.querySelector(".post-link");
    const title = postItem.querySelector(".post-block h2");

    const addActive = () => {
      if (image) image.classList.add("active");
      if (title) title.classList.add("active");
    };

    const removeActive = () => {
      if (image) image.classList.remove("active");
      if (title) title.classList.remove("active");
    };

    if (image) {
      image.addEventListener("mouseover", addActive);
      image.addEventListener("mouseout", removeActive);
    }

    if (title) {
      title.addEventListener("mouseover", addActive);
      title.addEventListener("mouseout", removeActive);
    }
  });

  const progressBar = document.getElementById("progress-bar");
  const postContent = document.querySelector(".single-post");

  if (progressBar && postContent) {
    const postHeight = postContent.scrollHeight;
    const postTop = postContent.offsetTop;

    window.addEventListener("scroll", () => {
      const scrollTop = window.scrollY;
      const scrollProgress = scrollTop - postTop;
      const totalScrollable = postHeight - window.innerHeight;

      let progressPercentage = (scrollProgress / totalScrollable) * 100;

      if (progressPercentage < 0) progressPercentage = 0;
      if (progressPercentage > 100) progressPercentage = 100;

      progressBar.style.width = progressPercentage + "%";
    });
  }
});
