document.getElementById('jobForm').addEventListener('submit', function(event) {
    var firstName = document.getElementById('first_name').value;
    var lastName = document.getElementById('last_name').value;
    var email = document.getElementById('email').value;
    var location = document.getElementById('location').value;
    var description = document.getElementById('description').value;

    if (firstName === '' || lastName === '' || email === '' || location === '' || description === '') {
        alert('All fields are required.');
        event.preventDefault();
    }

    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        event.preventDefault();
    }
});

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
