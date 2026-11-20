function togglePassword() {
    var passwordBox = document.getElementById("password");
    var eye = document.getElementById("eyeIcon");

    if (passwordBox.type == "password") {
        passwordBox.type = "text";
        eye.innerHTML = "&#128584;";
    }
    else {
        passwordBox.type = "password";
        eye.innerHTML = "&#128065;";
    }
}

function emailCheck() {
    var checked = document.getElementById("emailConfirm").checked;

    if (checked) {
        document.getElementById("emailRequired").style.visibility = "visible";
    }
    else {
        document.getElementById("emailRequired").style.visibility = "hidden";
    }
}

function resetForm() {
    document.getElementById("password").type = "password";
    document.getElementById("eyeIcon").innerHTML = "&#128065;";
    document.getElementById("emailRequired").style.visibility = "hidden";
}

function showError(fieldId, message) {
    alert(message);
    var field = document.getElementById(fieldId);
    field.focus();
    field.select();
}

// VALIDATE
function validateForm() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var password = document.getElementById("password").value;
    var repId = document.getElementById("repId").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var emailConfirm = document.getElementById("emailConfirm").checked;

    var namePattern = /^[A-Za-z]+([' -][A-Za-z]+)*$/;
    var idPattern = /^[0-9]{4}$/;
    var phonePattern = /^([0-9]{3}-[0-9]{3}-[0-9]{4}|[0-9]{3} [0-9]{3} [0-9]{4}) ext [0-9]{1,5}$/i;
    var emailPattern = /^[A-Za-z0-9._-]+@[A-Za-z0-9-]+\.[A-Za-z]{2,5}$/;

    if (firstName == "") {
        showError("firstName", "Moving Representative's First Name is required. Please enter your first name.");
        return false;
    }
    if (!namePattern.test(firstName)) {
        showError("firstName", "Moving Representative's First Name should contain only letters (a hyphen, apostrophe or single space between letters is allowed). Please re-enter.");
        return false;
    }

    if (lastName == "") {
        showError("lastName", "Moving Representative's Last Name is required. Please enter your last name.");
        return false;
    }
    if (!namePattern.test(lastName)) {
        showError("lastName", "Moving Representative's Last Name should contain only letters (a hyphen, apostrophe or single space between letters is allowed). Please re-enter.");
        return false;
    }

    if (password == "") {
        showError("password", "Moving Representative's Password is required. Please enter your password.");
        return false;
    }
    if (password.length > 7) {
        showError("password", "Moving Representative's Password can be a maximum of 7 characters. Please re-enter.");
        return false;
    }
    if (!/^[!@#$%^&*]/.test(password)) {
        showError("password", "Moving Representative's Password must START with a special character (! @ # $ % ^ & *). Please re-enter.");
        return false;
    }
    if (!/[A-Z]/.test(password)) {
        showError("password", "Moving Representative's Password must contain at least 1 uppercase letter. Please re-enter.");
        return false;
    }
    if (!/[!@#$%^&*]/.test(password.substring(1))) {
        showError("password", "Moving Representative's Password must contain at least 1 more special character (! @ # $ % ^ & *) after the first one. Please re-enter.");
        return false;
    }
    if (!/[0-9]/.test(password)) {
        showError("password", "Moving Representative's Password must contain at least 1 number. Please re-enter.");
        return false;
    }
    if (!/^[A-Za-z0-9!@#$%^&*]+$/.test(password)) {
        showError("password", "Moving Representative's Password can only contain letters, numbers and the special characters ! @ # $ % ^ & * (no spaces). Please re-enter.");
        return false;
    }

    if (repId == "") {
        showError("repId", "Moving Representative's ID is required. Please enter your ID.");
        return false;
    }
    if (!idPattern.test(repId)) {
        showError("repId", "Moving Representative's ID should consist of only numbers and be 4 digits in length. Please re-enter.");
        return false;
    }

    if (phone == "") {
        showError("phone", "Moving Representative's Phone # is required. Please enter your phone number.");
        return false;
    }
    if (!phonePattern.test(phone)) {
        showError("phone", "Moving Representative's Phone # should be 10 digits separated by dashes OR spaces (not both), followed by ext and your extension. Example: 555-555-5555 ext 555. Please re-enter.");
        return false;
    }

    if (emailConfirm) {
        if (email == "") {
            showError("email", "You requested an Email Confirmation, so Moving Representative's Email is required. Please enter your email.");
            return false;
        }
        if (!emailPattern.test(email)) {
            showError("email", "Moving Representative's Email must contain an @ followed by a domain, a period and a 2 to 5 letter ending. Example: john@LL.com. Please re-enter.");
            return false;
        }
    }

    return true;
}

function checkField(fieldId, pattern, fieldName, help) {
    var value = document.getElementById(fieldId).value;

    if (value == "") {
        showError(fieldId, fieldName + " is required. Please enter the " + fieldName + ".");
        return false;
    }
    if (!pattern.test(value)) {
        showError(fieldId, fieldName + " is not valid. " + help + " Please re-enter.");
        return false;
    }
    return true;
}

// VALIDATE CLIENT
function validateClient() {
    if (!checkField("clientFirstName", /^[A-Za-z]+([' -][A-Za-z]+)*$/, "Client's First Name", "It should contain only letters (a hyphen, apostrophe or single space between letters is allowed).")) {
        return false;
    }
    if (!checkField("clientLastName", /^[A-Za-z]+([' -][A-Za-z]+)*$/, "Client's Last Name", "It should contain only letters (a hyphen, apostrophe or single space between letters is allowed).")) {
        return false;
    }
    if (!checkField("clientId", /^[0-9]{4}$/, "Client ID", "It should consist of only numbers and be 4 digits in length. Example: 7001.")) {
        return false;
    }
    return true;
}

// VALIDATE ADDRESS
function checkAddress() {
    if (!checkField("streetNumber", /^[0-9]{1,6}$/, "Street Number", "It should be only numbers (up to 6 digits). Example: 88.")) {
        return false;
    }
    if (!checkField("streetName", /^[A-Za-z0-9][A-Za-z0-9 .'-]{1,39}$/, "Street Name", "It should be letters, numbers and spaces (up to 40 characters). Example: Ocean Avenue.")) {
        return false;
    }
    if (!checkField("city", /^[A-Za-z][A-Za-z .'-]{1,29}$/, "City", "It should be letters and spaces only (up to 30 characters). Example: Newark.")) {
        return false;
    }
    if (!checkField("state", /^[A-Za-z]{2}$/, "State", "It should be the 2 letter state code. Example: NJ.")) {
        return false;
    }
    if (!checkField("zip", /^[0-9]{5}$/, "Zip Code", "It should be exactly 5 digits. Example: 07102.")) {
        return false;
    }
    return true;
}

// VALIDATE BOOKING
function validateBook() {
    if (!checkAddress()) {
        return false;
    }
    if (!checkField("movingDate", /^((0?[1-9]|1[0-2])[\/-](0?[1-9]|[12][0-9]|3[01])[\/-]([0-9]{2}|[0-9]{4})|(January|February|March|April|May|June|July|August|September|October|November|December) (0?[1-9]|[12][0-9]|3[01]), [0-9]{4})$/, "Moving Date", "Examples: 12/05/2026, 12/05/26, 12-05-2026 or December 5, 2026.")) {
        return false;
    }
    if (!checkField("weight", /^[0-9]{1,6}( ?(lbs|lb|kg))?$/i, "Total Weight", "It should be a number with an optional lbs or kg. Example: 2500 lbs.")) {
        return false;
    }
    if (!checkField("miles", /^[0-9]{1,5}(\.[0-9]{1,2})?$/, "Miles For Move", "It should be a number. Example: 35 or 35.5.")) {
        return false;
    }
    if (!checkField("cost", /^\$?[0-9]{1,7}(\.[0-9]{2})?$/, "Total Cost", "It should be a dollar amount with no commas. Example: $1250.00.")) {
        return false;
    }
    return confirm("Do you want to continue booking the moving event?");
}

// VALIDATE CLIENT INFORMATION
function validateClientInfo() {
    if (!checkAddress()) {
        return false;
    }
    if (!checkField("clientPhone", /^([0-9]{3}-[0-9]{3}-[0-9]{4}|[0-9]{3} [0-9]{3} [0-9]{4})$/, "Client Phone Number", "It should be 10 digits separated by dashes OR spaces (not both). Example: 973-555-0101.")) {
        return false;
    }
    return true;
}

// VALIDATE SPECIAL INSTRUCTIONS
function checkInstructions() {
    if (!checkField("clientId", /^[0-9]{4}$/, "Client ID", "It should consist of only numbers and be 4 digits in length. Example: 7001.")) {
        return false;
    }
    if (!checkField("movingId", /^[0-9]{5}$/, "Moving ID", "It should consist of only numbers and be 5 digits in length. Example: 48213.")) {
        return false;
    }
    if (!checkField("instructions", /^[A-Za-z0-9 .,!?'&()\/\n\r-]{5,500}$/, "Special Instructions", "It should be 5 to 500 characters using letters, numbers, spaces and basic punctuation.")) {
        return false;
    }
    return true;
}

function validateInstructions() {
    if (!checkInstructions()) {
        return false;
    }
    return confirm("Do you wish to request special instructions for this move?");
}

function validateUpdate() {
    if (!checkInstructions()) {
        return false;
    }
    return confirm("Are you sure you want to update the client's additional special instructions?");
}