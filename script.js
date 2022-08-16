document.querySelector(".open").addEventListener("click", function(){
 document.forms.addcompany.classList.toggle("d-none");
 let alert = document.querySelector(".alert");
 if(alert){
  alert.remove();
 }
})


window.addEventListener('click', clickBtn);
function clickBtn(event){
 if(event.target.dataset.action === 'open'){
  const wrapBtn = event.target.closest('.wrap');
  let form = document.createElement('form');
  form.classList.add("col-md-12", "out");
  form.setAttribute("name", "commit")
  wrapBtn.insertAdjacentElement('afterEnd', form);

  let inp = document.createElement('input');
  inp.setAttribute('type', 'text')
  inp.classList.add("col-md-6");
  let inpBtn = document.createElement('input');
  inpBtn.type = "submit";
  inpBtn.setAttribute('sub', 'commit')
  inpBtn.classList.add("col-md-4");
  form.append(inp, inpBtn);
 }
}

window.addEventListener("click", event => {
   if (event.target.matches('[sub="commit"]')) {
      event.preventDefault();
      const wrapOut = event.target.closest('.out');
      const out = wrapOut.querySelector('[type="text"]').value;
      const formData = new FormData();
      formData.append('commit' ,out);
      fetch("commit.php",{
       method: 'post',
       body: formData,
    })
    .then(response => response.text()) 
    .then(data =>{
       console.log(data);
       let div = document.createElement('div');
       div.classList.add("col-md-12");
       let infoP = document.createElement('p');
       infoP.innerText = data;
       div.append(infoP);
       wrapOut.insertAdjacentElement('afterEnd', div)
       
       document.querySelector(".out").remove();
    })
   }
 }, false);

