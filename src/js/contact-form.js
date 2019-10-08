;(function() {

	const form = document.forms.contact_form;
	const actionUrl = "http://httpbin.org/post";


	// Form Validation

	const formInputs = {};
	let showButton = false;

	const patterns = {
		email: new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i),
		tel: new RegExp(/^\+?(\d[\d\-\+\.\(\) ]{5,}\d$)/)
	};

	for (let input of form) {


		// avoid buttons
		if ("button" == input.localName)
			continue;

		// set checkbox rules
		if ("checkbox" == input.type) {
		
			if ( checkCheckbox(input) ) {
				approveInput(input, formInputs);
			} else {
				denyInput(input, formInputs);
			};


			input.onchange = function() {
				if ( checkCheckbox(input) ) {
					approveInput(input, formInputs);
				} else {
					denyInput(input, formInputs);
				};
				checkStatus(formInputs);
			}

			checkStatus(formInputs);
			continue;
		}

		// set inputs rules
		let value = input.value;

		if (!value) {
			denyInput(input, formInputs);
		} else {
			if (!patterns[input.type]) {
				approveInput(input, formInputs);
			} else {
				if (!patterns[input.type].test(input.value)) {
					denyInput(input, formInputs);
				} else {
					approveInput(input, formInputs);
				};
			}
		}


		checkStatus(formInputs);


		// Event "input is changed"

		input.onkeyup = function() {

			// has no value
			if (checkEmpty(input)) {
				denyInput(input, formInputs);

				if ( hasError(input) )
					removeErrorHTML(input);
				
				checkStatus(formInputs);
				return;
			}

			// simple type check
			if (input.value && !patterns[input.type]) {
				approveInput(input, formInputs);
				
				checkStatus(formInputs);
				return;
			}

			// validated type check
			if ( patterns[input.type].test(input.value) ) {
				approveInput(input, formInputs);

				if ( hasError(input) )
					removeErrorHTML(input);

				checkStatus(formInputs);

			} else {
				denyInput(input, formInputs);
				checkStatus(formInputs);
			}
		};


		// Event "input is blured"

		input.onblur = function() {

			// has no value
			if (checkEmpty(input)) {
				removeErrorHTML(input);

				if ( hasError(input) )
					removeErrorHTML(input);

				checkStatus(formInputs);
				return;
			};

			// simple type check
			if (input.value && !patterns[input.type]) {
				approveInput(input, formInputs);
				
				checkStatus(formInputs);
				return;
			}

			// validated type check
			if (patterns[input.type]) {
				if (!patterns[input.type].test(input.value)) {
					createErrorHTML(input, "Bad validation");
					denyInput(input, formInputs);
				} else {
					approveInput(input, formInputs);
				};
			};

			checkStatus(formInputs);
		}
	}

	function checkCheckbox(input) {
		return input.checked;
	}

	function checkStatus(formInputs) {
		let status = Object.values(formInputs).every(function(val) {
			return val == 1;
		} );

		if (status) {

			if (showButton == true)
				return;

			let button = form.querySelector(".js-submit");
			let buttonClassArray = button.className.split(" ");

			if (buttonClassArray.indexOf("btn--submit-active") == -1) {
				buttonClassArray.push("btn--submit-active");
				button.className = buttonClassArray.join(" ");
			}

			showButton = true;

		} else {
			
			if (showButton != true)
				return;

			let button = form.querySelector(".js-submit");
			button.classList.remove("btn--submit-active");

			showButton = false;
		}
	}

	function checkEmpty(input) {
		if (!input.value)
			return true;

		return false;
	}

	function hasError(input) {
		let parent = input.parentElement;
		let oldElem = parent.querySelector(".form__error");

		if (oldElem)
			return true;

		return false;
	}

	function addParentBorder(element) {
		let classArray = element.className.split(" ");

		if (classArray.indexOf("form__field--error") == -1) {
			classArray.push("form__field--error");
			element.className = classArray.join(" ");
		}
	}

	function removeParentBorder(element) {
		element.classList.remove("form__field--error");
	}

	function createErrorHTML(input, errorText) {
		let parent = input.parentElement;
		let oldElem = parent.querySelector(".form__error");

		if (oldElem)
			return;

		let elem = document.createElement("div");
		let text = document.createTextNode(errorText); 
		elem.classList = "form__error";
		elem.appendChild(text);
		parent.insertBefore(elem, input);
		addParentBorder(parent);
	}

	function removeErrorHTML(input) {
		let parent = input.parentElement;
		let oldElem = parent.querySelector(".form__error");

		if (oldElem) {
			oldElem.remove();
			removeParentBorder(parent);
		}
	}

	function approveInput(input, inputsArray) {
		if (inputsArray[input.name] === 1)
			return;

		inputsArray[input.name] = 1;
	}

	function denyInput(input, inputsArray) {
		if (inputsArray[input.name] === 0)
			return;

		inputsArray[input.name] = 0;
	}


	// Form sending

	form.addEventListener('submit', function(event) {
		event.preventDefault();

		// return;
		
		let data = {};		
		for (let input of form) {
			if (input.name && input.value) {
				data[input.name] = input.value;
			}
		}

		let args = {
			method: "POST",
			body: JSON.stringify(data),
		};

		fetch(actionUrl, args).then(function(res) {
			if (res.ok) {
				console.log(res);
			} else {
				console.log("error", res);
			}
		});

	});

})();