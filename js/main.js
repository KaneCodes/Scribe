// Variables
const createBtn = document.getElementById('create-btn');
const register = document.getElementById('register-form');
const login = document.getElementById('login-form');

// Event Listener
createBtn.addEventListener("click", function(){
  displayForm();
});

// Functions
function displayForm(){
  register.classList.remove("hide");
  login.classList.add("hide");
}
