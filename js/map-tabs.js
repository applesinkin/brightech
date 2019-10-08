"use strict";

;

(function () {
  var container = document.querySelector('.js-tabs');
  var btns = container.querySelectorAll('.js-tabs-btn');
  var bodies = container.querySelectorAll('.js-tabs-body');
  container.addEventListener("click", function (event) {
    var classArray = event.target.className.trim().split(" ");

    if (classArray.includes("js-tabs-btn")) {
      event.preventDefault();

      for (var i = 0; i < btns.length; i++) {
        if (event.target === btns[i]) {
          addCurrentTabClass(btns[i]);
          changeMapPosition(btns[i]);
          displayCurrentTab(i);
          continue;
        }

        removeCurrentTabClass(btns[i]);
      }
    }
  });

  function displayCurrentTab(current) {
    for (var i = 0; i < bodies.length; i++) {
      bodies[i].style.display = current === i ? "block" : "none";
    }
  }

  function addCurrentTabClass(current) {
    var classArray = current.className.split(" ");

    if (classArray.indexOf("active") == -1) {
      classArray.push("active");
      current.className = classArray.join(" ");
    }
  }

  function removeCurrentTabClass(current) {
    current.classList.remove("active");
  }

  function changeMapPosition(current) {
    var lat = +current.getAttribute("data-lat");
    var lng = +current.getAttribute("data-lng");
    window.tabsMapLat = lat;
    window.tabsMapLng = lng;

    if (window.tabsMap) {
      window.tabsMap.setCenter({
        lat: lat,
        lng: lng
      });
      window.tabsMapMarker.setPosition({
        lat: lat,
        lng: lng
      });
    }
  }
})();
//# sourceMappingURL=maps/map-tabs.js.map
