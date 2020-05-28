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
function ToggleModal(event) {
  let modal = document.getElementById("modal");

  if(event.target.tagName!=='BUTTON' && event.target.tagName!=='INPUT'){

  // if (modal.style.display === "block") {
  //   modal.style.display = "none";
  // } else {
  //   modal.style.display = "block";
  // }
  // console.log(event.target);
  modal.style.display = "block";
  var t;
  if(event.target.className==='card'){
    t = event.target;
  }
  else if(event.target.tagName==='IMG'){
    t = event.target.parentNode.parentNode;
  }
  else{
    t = event.target.parentNode;
  }
  
  // console.log(t.children[3].children[1].children[0].value);

  var img = t.children[0].children[0].src;
  var pname = t.children[2].childNodes[0].textContent;
  var desc = t.children[1].textContent;
  var price = t.children[2].children[1].textContent

  document.getElementById("modalimg").src = img; 
  document.getElementById("modalpname").childNodes[0].textContent = pname;
  document.getElementById("modalprice").textContent = price;
  document.getElementById("modaldesc").textContent = desc;
  document.getElementById("gallery").style.marginRight = "35%";

  var form = document.createElement("form");
  form.action = "addtocart.php";
  form.method = "post";
  form.id = "form-modal";
  var btnmodal = document.getElementById("btn-modal");
  btnmodal.type = "submit";
  btnmodal.name = "pid";
  // console.log(t.children);
  btnmodal.value = t.children[3].children[1].children[0].value;

  btnmodal.parentNode.insertBefore(form,btnmodal);
  
  var hiddeninput = document.createElement('input');
  hiddeninput.type = 'hidden';
  hiddeninput.name = 'quantity';
  hiddeninput.value = '1';
  form.appendChild(hiddeninput);
  form.appendChild(btnmodal);
  
  // console.log(t.children[3].children[0].value);
  // console.log(btnmodal.parentElement.parentElement);

  var cardsClasses = document.getElementsByClassName('card');
  for(i=0;i<cardsClasses.length;i++){
    cardsClasses[i].style.background = 'white';
    cardsClasses[i].children[1].style.color = '#83888b';
    cardsClasses[i].children[2].style.color = '#83888b';
  }
  
  t.style.background = "#4287f5";
  t.children[1].style.color = "white";
  t.children[2].style.color = "white";
}
else if(event.target.tagName==='INPUT'&& modal.style.display ==='block'){
  console.log(event.target.value);
  document.getElementById("form-modal").children[0].value = event.target.value;
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
  document.getElementById("gallery").style.marginRight = "0";
  var cardsClasses = document.getElementsByClassName('card');
  for(i=0;i<cardsClasses.length;i++){
    cardsClasses[i].style.background = 'white';
    cardsClasses[i].children[1].style.color = '#83888b';
    cardsClasses[i].children[2].style.color = '#83888b';

  }
}

function Snack() {

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function() {
    x.className = x.className.replace("show", "");
  }, 3000);
}
