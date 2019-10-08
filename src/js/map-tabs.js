;(function() {

	const container = document.querySelector('.js-tabs');
	const btns = container.querySelectorAll('.js-tabs-btn');
	const bodies = container.querySelectorAll('.js-tabs-body');

	container.addEventListener("click", function(event) {
		let classArray = event.target.className.trim().split(" ");

		if (classArray.includes("js-tabs-btn")) {

			event.preventDefault();
			for (let i = 0; i < btns.length; i++) {
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
		for (let i = 0; i < bodies.length; i++) {
			bodies[i].style.display = (current === i) ? "block" : "none";
		}
	}

	function addCurrentTabClass(current) {
		let classArray = current.className.split(" ");

		if (classArray.indexOf("active") == -1) {
			classArray.push("active");
			current.className = classArray.join(" ");
		}
	}

	function removeCurrentTabClass(current) {
		current.classList.remove("active");
	}

	function changeMapPosition(current) {
		let lat = +current.getAttribute("data-lat");
		let lng = +current.getAttribute("data-lng");
		window.tabsMapLat = lat;
		window.tabsMapLng = lng;

		if ( window.tabsMap ) {
			window.tabsMap.setCenter({lat, lng});
			window.tabsMapMarker.setPosition({lat, lng});
		}
	}

})();