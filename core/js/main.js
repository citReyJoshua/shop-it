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

const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});
