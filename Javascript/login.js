const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");


form.onsubmit = (e)=>{
   e.preventDefault();
}

continueBtn.onclick = ()=>{
     // let start Ajax
     let xhr = new XMLHttpRequest(); // Creating XML object
     xhr.open("POST", "php/login.php", true);
     xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;

                console.log(data);
                if(data == "success") {
                    location.href = "users.php";
                }else{                     
                    errorText.style.display = "block";             
                    errorText.textContent = data;
                }
                
            }
        }
     }
     /* we have to send the form data trought ajax to php */
     let formData = new FormData(form); //creating new form ajax object
     xhr.send(formData); // sending the form data to php
}