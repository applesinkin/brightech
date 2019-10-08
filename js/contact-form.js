"use strict";

;

(function () {
  var form = document.forms.contact_form;
  var actionUrl = "http://httpbin.org/post"; // Form Validation

  var formInputs = {};
  var showButton = false;
  var patterns = {
    email: new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i),
    tel: new RegExp(/^\+?(\d[\d\-\+\.\(\) ]{5,}\d$)/)
  };
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    var _loop = function _loop() {
      var input = _step.value;
      // avoid buttons
      if ("button" == input.localName) return "continue"; // set checkbox rules

      if ("checkbox" == input.type) {
        if (checkCheckbox(input)) {
          approveInput(input, formInputs);
        } else {
          denyInput(input, formInputs);
        }

        ;

        input.onchange = function () {
          if (checkCheckbox(input)) {
            approveInput(input, formInputs);
          } else {
            denyInput(input, formInputs);
          }

          ;
          checkStatus(formInputs);
        };

        checkStatus(formInputs);
        return "continue";
      } // set inputs rules


      var value = input.value;

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
          }

          ;
        }
      }

      checkStatus(formInputs); // Event "input is changed"

      input.onkeyup = function () {
        // has no value
        if (checkEmpty(input)) {
          denyInput(input, formInputs);
          if (hasError(input)) removeErrorHTML(input);
          checkStatus(formInputs);
          return;
        } // simple type check


        if (input.value && !patterns[input.type]) {
          approveInput(input, formInputs);
          checkStatus(formInputs);
          return;
        } // validated type check


        if (patterns[input.type].test(input.value)) {
          approveInput(input, formInputs);
          if (hasError(input)) removeErrorHTML(input);
          checkStatus(formInputs);
        } else {
          denyInput(input, formInputs);
          checkStatus(formInputs);
        }
      }; // Event "input is blured"


      input.onblur = function () {
        // has no value
        if (checkEmpty(input)) {
          removeErrorHTML(input);
          if (hasError(input)) removeErrorHTML(input);
          checkStatus(formInputs);
          return;
        }

        ; // simple type check

        if (input.value && !patterns[input.type]) {
          approveInput(input, formInputs);
          checkStatus(formInputs);
          return;
        } // validated type check


        if (patterns[input.type]) {
          if (!patterns[input.type].test(input.value)) {
            createErrorHTML(input, "Bad validation");
            denyInput(input, formInputs);
          } else {
            approveInput(input, formInputs);
          }

          ;
        }

        ;
        checkStatus(formInputs);
      };
    };

    for (var _iterator = form[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var _ret = _loop();

      if (_ret === "continue") continue;
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  function checkCheckbox(input) {
    return input.checked;
  }

  function checkStatus(formInputs) {
    var status = Object.values(formInputs).every(function (val) {
      return val == 1;
    });

    if (status) {
      if (showButton == true) return;
      var button = form.querySelector(".js-submit");
      var buttonClassArray = button.className.split(" ");

      if (buttonClassArray.indexOf("btn--submit-active") == -1) {
        buttonClassArray.push("btn--submit-active");
        button.className = buttonClassArray.join(" ");
      }

      showButton = true;
    } else {
      if (showButton != true) return;

      var _button = form.querySelector(".js-submit");

      _button.classList.remove("btn--submit-active");

      showButton = false;
    }
  }

  function checkEmpty(input) {
    if (!input.value) return true;
    return false;
  }

  function hasError(input) {
    var parent = input.parentElement;
    var oldElem = parent.querySelector(".form__error");
    if (oldElem) return true;
    return false;
  }

  function addParentBorder(element) {
    var classArray = element.className.split(" ");

    if (classArray.indexOf("form__field--error") == -1) {
      classArray.push("form__field--error");
      element.className = classArray.join(" ");
    }
  }

  function removeParentBorder(element) {
    element.classList.remove("form__field--error");
  }

  function createErrorHTML(input, errorText) {
    var parent = input.parentElement;
    var oldElem = parent.querySelector(".form__error");
    if (oldElem) return;
    var elem = document.createElement("div");
    var text = document.createTextNode(errorText);
    elem.classList = "form__error";
    elem.appendChild(text);
    parent.insertBefore(elem, input);
    addParentBorder(parent);
  }

  function removeErrorHTML(input) {
    var parent = input.parentElement;
    var oldElem = parent.querySelector(".form__error");

    if (oldElem) {
      oldElem.remove();
      removeParentBorder(parent);
    }
  }

  function approveInput(input, inputsArray) {
    if (inputsArray[input.name] === 1) return;
    inputsArray[input.name] = 1;
  }

  function denyInput(input, inputsArray) {
    if (inputsArray[input.name] === 0) return;
    inputsArray[input.name] = 0;
  } // Form sending


  form.addEventListener('submit', function (event) {
    event.preventDefault(); // return;

    var data = {};
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = form[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var input = _step2.value;

        if (input.name && input.value) {
          data[input.name] = input.value;
        }
      }
    } catch (err) {
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
          _iterator2["return"]();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
        }
      }
    }

    var args = {
      method: "POST",
      body: JSON.stringify(data)
    };
    fetch(actionUrl, args).then(function (res) {
      if (res.ok) {
        console.log(res);
      } else {
        console.log("error", res);
      }
    });
  });
})();
//# sourceMappingURL=maps/contact-form.js.map
