var reps = [
    {firstName: "John", lastName: "Doe", password: "$Abc12", id: "1234", phone: "555-555-5555 ext 555", email: "john@ll.com"},
    {firstName: "Jane", lastName: "Smith", password: "#Move7", id: "2345", phone: "201-555-1111 ext 101", email: "jane@mou.com"},
    {firstName: "Barry", lastName: "Box", password: "@Box99", id: "3456", phone: "973-555-2222 ext 22", email: "barry@mou.com"},
    {firstName: "Maria", lastName: "Lopez", password: "!Van5", id: "4567", phone: "732-555-3333 ext 3", email: "maria@mou.org"},
    {firstName: "Tom", lastName: "Brown", password: "%Truck1", id: "5678", phone: "908-555-4444 ext 404", email: "tom@mou.net"},
    {firstName: "Linda", lastName: "Green", password: "&Lift2", id: "6789", phone: "856-555-5555 ext 55", email: "linda@mou.com"},
    {firstName: "Kevin", lastName: "White", password: "*Pack3", id: "7890", phone: "609-555-6666 ext 6", email: "kevin@mou.info"},
    {firstName: "Sara", lastName: "Black", password: "^Load4", id: "8901", phone: "551-555-7777 ext 707", email: "sara@mou.com"},
    {firstName: "Mike", lastName: "Gray", password: "$Haul8", id: "9012", phone: "862-555-8888 ext 88", email: "mike@mou.com"},
    {firstName: "Anna", lastName: "Reed", password: "#Ship6", id: "1357", phone: "848-555-9999 ext 9", email: "anna@mou.com"}
];

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
    var phonePattern = /^[0-9]{3}[- ][0-9]{3}[- ][0-9]{4} ext [0-9]{1,5}$/i;
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
        showError("phone", "Moving Representative's Phone # should be 10 digits separated by dashes or spaces, followed by ext and your extension. Example: 555-555-5555 ext 555. Please re-enter.");
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

    verifyRep();
    return false;
}

// VERIFY
function verifyRep() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var password = document.getElementById("password").value;
    var repId = document.getElementById("repId").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var emailConfirm = document.getElementById("emailConfirm").checked;
    var transaction = document.getElementById("transaction").value;

    var phoneDigits = phone.replace(/[^0-9]/g, "");

    for (var i = 0; i < reps.length; i++) {
        var repPhoneDigits = reps[i].phone.replace(/[^0-9]/g, "");

        if (firstName == reps[i].firstName &&
            lastName == reps[i].lastName &&
            password == reps[i].password &&
            repId == reps[i].id &&
            phoneDigits == repPhoneDigits) {

            if (emailConfirm == false || email.toLowerCase() == reps[i].email.toLowerCase()) {
                alert("Welcome to Moving On Up, " + firstName + " " + lastName + "! You have entered the system. Transaction chosen: " + transaction + ".");
                return true;
            }
        }
    }

    alert("Sorry, an account for " + firstName + " " + lastName + " cannot be found.");
    return false;
}