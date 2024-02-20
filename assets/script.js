var checkSelectorExistence = function (selectorName) {
  if (jQuery(selectorName).length > 0) {
    return true;
  } else {
    return false;
  }
};


var setUpcomingEventCarousel = function () {
  if (!checkSelectorExistence(".upcoming-event-carousel")) {
    return;
  }
  jQuery(".upcoming-event-carousel").owlCarousel({
    center: true,
    autoplay: true,
    items: 3,
    loop: true,
    margin: 40,
    nav: false,
    dots: true,
    autoplaySpeed: 1000,
    navSpeed: 1000,
    paginationSpeed: 1000,
    slideSpeed: 1000,
    navText: [
      '<i class="fas fa-angle-left"></i>',
      '<i class="fas fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      650: {
        items: 1.5,
      },
      1024: {
        items: 2,
      },
      1200: {
        items: 2,
      },
    },
  });
};


var setRecentNewsCarousel = function () {
            if (!checkSelectorExistence(".recent-news-carousel")) {
              return;
            }
            jQuery(".recent-news-carousel").owlCarousel({
              loop: true,
              autoplay: true,
              margin: 30,
              nav: false,
              dots: true,
              navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
              ],
              responsive: {
                  0: {
                      items: 1,
                    },
                480: {
                    items: 2,
                },
                1024: {
                    items: 3,
                },
                1200: {
                    items: 3,
                },
            },
        });
    };
    
    setUpcomingEventCarousel();
    setRecentNewsCarousel();
