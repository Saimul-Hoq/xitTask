

let successStatus = document.getElementById("status").textContent;
if(successStatus === "true"){
    document.getElementById("successPopup").classList.add("open");
    document.getElementById("signup-form").classList.add("success");
    // document.getElementById("fieldset").disabled = true;
    document.getElementById("signup-back-btn").removeAttribute("href");
    // document.getElementById("signup-register-btn").disabled = true;

}