const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
 }

sendBtn.onclick = ()=>{
     // let start Ajax
     let xhr = new XMLHttpRequest(); // Creating XML object
     xhr.open("POST", "php/insert-chat.php", true);
     xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                inputField.value = ""; // ONCE MESSAGE INSERTED INTO DATABASE THEN LEAVE BLANK THE INPUT FIELD
                scrollToBottom();
            }
        }
     }
     /* we have to send the form data trought ajax to php */
     let formData = new FormData(form); //creating new form ajax object
     xhr.send(formData); // sending the form data to php
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{

    // let start Ajax
    let xhr = new XMLHttpRequest(); // Creating XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
       if(xhr.readyState === XMLHttpRequest.DONE) {
           if(xhr.status === 200) {
               let data = xhr.response;
               chatBox.innerHTML = data; 
               if(!chatBox.classList.contains("active")){ // if active class not contains in chatbox the scroll to bottom
                scrollToBottom();
               }
           }
       }
    }

     /* we have to send the form data trought ajax to php */
     let formData = new FormData(form); //creating new form ajax object
     xhr.send(formData); // sending the form data to php
    
}, 500); // this function will run frequently after 500ms

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}