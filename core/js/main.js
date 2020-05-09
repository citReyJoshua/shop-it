function ToggleSlide() {
  let element = document.getElementById("user-links");
  let search = document.getElementById("search");
  if (element.style.display === "none") {
    search.style.marginRight = "-70px";
    element.style.display = "flex";
  } else {
    search.style.marginRight = "0";
    element.style.display = "none";
  }
}
function ToggleModal() {
  let modal = document.getElementById("modal");

  if (modal.style.display === "block") {
    modal.style.display = "none";
  } else {
    modal.style.display = "block";
  }
}

const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");


signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

function Close() {
  let modal = document.getElementById("modal");

  modal.style.display = "none";
}

function Snack() {

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function() {
    x.className = x.className.replace("show", "");
  }, 3000);
}
