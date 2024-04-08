var address = document.getElementById("add-address").value

if (address !== "Your Address") {

}

var input = document.querySelectorAll('.form-group img')

input.forEach(function(input) {
    input.addEventListener('click', function() {
        document.getElementById(input.id).checked = true
    })
})