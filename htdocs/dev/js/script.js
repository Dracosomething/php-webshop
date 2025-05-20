function each(obj, cb) {
    for (const key in obj) {
        if (false === cb(obj[key], key)) {
            return false;
        }
    }
    return true;
}

function toNumber(value) {
    const number = Number(value);
    return isNaN(number) ? false : number;
}

function isBetween(obj, min, max) {
    const value = toNumber(obj);
    const minVal = toNumber(min);
    const maxVal = toNumber(max);
    return value >= minVal && minVal <= value && maxVal >= value && value <= maxVal;
}

function isObject(obj) {
    return obj !== null && typeof obj === "object";
}

function isEqual(value, other) {
    return value === other || isObject(value) && isObject(other) && Object.keys(value).length === Object.keys(other).length && each(value, (val, key) => val === other[key]);
}

function passEqual(pass1, pass2) {
    return isEqual(pass1, pass2);
}

function passwordCheck() {
    pass1 = document.forms["register"]["password"].value;
    pass2 = document.forms["register"]["password-contr"].value;
    buttonRegister = document.forms["register"]["register"];
    if (passEqual(pass1, pass2)) {
        buttonRegister.removeAttribute("disabled");
    } else {
        buttonRegister.setAttribute("disabled", "");
    }
}

function addRedTextToEmptyInputFields(formName, checkForRegisterpage = false) {
    var form = document.forms[formName];
    for (i = 0; i < form.length; i++) {
        var input = form[i];
        if (input.parentElement.children.namedItem("redText") != null) {
            var text = input.parentElement.children.namedItem("redText");
            text.remove();
        }
        if (input.hasAttribute("required")) {
            if (input.value == "") {
                if (checkForRegisterpage) {
                    var error = document.getElementById("error-card");
                    error.style.removeProperty('display')
                }
                var textNode = document.createElement("p");
                textNode.textContent = "input required";
                textNode.classList.add("uk-text-meta");
                textNode.classList.add("uk-text-danger");
                textNode.id = "redText"
                input.parentElement.appendChild(textNode);
            } else if (checkForRegisterpage) {
                var error = document.getElementById("error-card");
                error.style.display = "none"
            }
        }
    }
}

function disableConfirm() {
    var button = document.forms["order"]["submit"];
    var bank = document.forms["order"]["bank"];
    var id = bank.value;
    if (id == 0) {
        button.setAttribute("disabled", "");
    } else {
        button.removeAttribute("disabled");
    }
}

function enableToCartIfProductAmountGood() {
    var input = document.forms["cart"]["amount"];
    var buttonToCart = document.forms["cart"]["toCart"];
    var amount = input.value;
    var min = input.min;
    var max = input.max;
    if (isBetween(amount, min, max)) {
        buttonToCart.removeAttribute("disabled");
    } else {
        buttonToCart.setAttribute("disabled", "");
    }
}