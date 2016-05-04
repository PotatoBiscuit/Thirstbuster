function validateForm() {
    var x = document.forms["form-group"]["venue_login1'].value;
    if (x == null || x == "") {
        alert("Form name must be filled out");
        return false;
    }
}