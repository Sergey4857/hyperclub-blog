//burger menu
jQuery(document).ready(function ($) {
  $(".burger-button").on("click", function (event) {
    event.stopPropagation();
    $(this).toggleClass("active");
    $(".burger-nav-wrap").toggleClass("active");
    $(".burger-backdrop").toggleClass("active");
  });

  $(".burger-nav-close").on("click", function (event) {
    event.stopPropagation();
    $(".burger-button, .burger-nav-wrap, .burger-backdrop").removeClass(
      "active"
    );
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest(".burger-nav-wrap, .burger-button").length) {
      $(".burger-button, .burger-nav-wrap, .burger-backdrop").removeClass(
        "active"
      );
    }
  });

  $(".burger-title").on("click", function () {
    $(".burger-block").not($(this).next(".burger-block")).slideUp(300);
    $(".burger-title").not(this).removeClass("active");

    $(this).next(".burger-block").slideToggle(300);
    $(this).toggleClass("active");
  });

  $(".burger-block").slideUp(0);
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

// Table of Contents functionality
function initTableOfContents() {
  const tocContainer = document.querySelector(
    ".table-of-contents .toc-content"
  );
  const tocWidget = document.querySelector(".table-of-contents");
  const headings = document.querySelectorAll(
    ".post-content-wrap h2, .post-content-wrap h3"
  );

  if (!tocContainer || !tocWidget) return;

  // Clear existing content
  tocContainer.innerHTML = "";

  // Create TOC list
  const tocList = document.createElement("ul");
  tocList.className = "toc-list";

  // Add IDs to headings and create TOC items
  headings.forEach((heading, index) => {
    if (!heading.id) {
      heading.id = `heading-${index}`;
    }

    const tocItem = document.createElement("li");
    const level = heading.tagName.toLowerCase();
    const isSubHeading = level === "h3";

    tocItem.className = `toc-item ${isSubHeading ? "toc-sub" : ""}`;

    const link = document.createElement("a");
    link.href = `#${heading.id}`;
    link.textContent = heading.textContent.trim();

    tocItem.appendChild(link);
    tocList.appendChild(tocItem);
  });

  tocContainer.appendChild(tocList);

  // Get all TOC links after creation
  const tocLinks = tocContainer.querySelectorAll(".toc-item a");

  // Function to update active TOC item
  function updateActiveTOCItem() {
    const scrollPosition = window.scrollY + 100; // Offset for sticky header

    let activeHeading = null;

    // Find the current active heading based on scroll position
    for (let i = 0; i < headings.length; i++) {
      const heading = headings[i];
      const headingTop = heading.offsetTop;
      const headingBottom = headingTop + heading.offsetHeight;

      // Check if we're currently viewing this heading
      if (scrollPosition >= headingTop && scrollPosition < headingBottom) {
        activeHeading = heading;
        break;
      }

      // If we've scrolled past this heading but haven't reached the next one,
      // keep the previous heading active
      if (scrollPosition >= headingTop) {
        activeHeading = heading;
      }
    }

    // Remove active class from all TOC links
    tocLinks.forEach((link) => {
      link.classList.remove("active");
    });

    // Add active class to current active TOC link
    if (activeHeading) {
      const activeLink = document.querySelector(
        `.table-of-contents .toc-item a[href="#${activeHeading.id}"]`
      );
      if (activeLink) {
        activeLink.classList.add("active");
      }
    }
  }

  // Smooth scroll to heading when TOC link is clicked
  tocLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href").substring(1);
      const targetHeading = document.getElementById(targetId);

      if (targetHeading) {
        const offsetTop = targetHeading.offsetTop - 100; // Account for sticky header
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });

        // Close mobile TOC after clicking on a link
        closeMobileTOC();
      }
    });
  });

  // Update active TOC item on scroll
  window.addEventListener("scroll", updateActiveTOCItem);

  // Initial call to set active item
  updateActiveTOCItem();
}

// Mobile TOC functionality
let closeMobileTOC; // Declare function in global scope

function initMobileTOC() {
  const tocToggleBtn = document.querySelector(".toc-toggle-btn");
  const postSidebar = document.querySelector(".post-sidebar");
  const tocCloseBtn = document.querySelector(".toc-close-btn");

  if (!tocToggleBtn || !postSidebar) return;

  // Toggle TOC open/close
  function toggleMobileTOC() {
    const isOpen = postSidebar.classList.contains("toc-open");

    if (isOpen) {
      closeMobileTOC();
    } else {
      openMobileTOC();
    }
  }

  // Open mobile TOC
  function openMobileTOC() {
    postSidebar.classList.add("toc-open");
    tocToggleBtn.classList.add("active");
    document.body.style.overflow = "hidden"; // Prevent background scroll
  }

  // Close mobile TOC
  closeMobileTOC = function () {
    postSidebar.classList.remove("toc-open");
    tocToggleBtn.classList.remove("active");
    document.body.style.overflow = ""; // Restore background scroll
  };

  // Event listeners
  tocToggleBtn.addEventListener("click", toggleMobileTOC);

  if (tocCloseBtn) {
    tocCloseBtn.addEventListener("click", closeMobileTOC);
  }

  // Close TOC when clicking outside
  postSidebar.addEventListener("click", (e) => {
    if (e.target === postSidebar) {
      closeMobileTOC();
    }
  });

  // Close TOC on escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeMobileTOC();
    }
  });
}

// Function to reinitialize TOC when content changes
function reinitTableOfContents() {
  // Small delay to ensure DOM is updated
  setTimeout(() => {
    initTableOfContents();
  }, 100);
}

// Initialize Table of Contents when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  initTableOfContents();
  initMobileTOC();

  // Reinitialize TOC when content might change (for dynamic content)
  if (typeof wp !== "undefined" && wp.ajax) {
    wp.ajax.addAction("content_updated", reinitTableOfContents);
  }
});

// Reinitialize TOC on window resize (in case layout changes affect heading positions)
window.addEventListener("resize", () => {
  reinitTableOfContents();
});
