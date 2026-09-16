// document.addEventListener('DOMContentLoaded', () => {
//     const dialog = document.getElementById('successDialog');

//     if (dialog.dataset.showSuccess === '1') {
//         dialog.showModal();
//     }

//     document.getElementById('closeDialog').addEventListener('click', () => {
//         dialog.close();
//     });
// });

let successStatus = document.getElementById("status").textContent;
if(successStatus === "true"){
    document.getElementById("successPopup").classList.add("open");
    document.getElementById("signup-form").classList.add("success");
    document.getElementById("fieldset").disabled = true;
    document.getElementById("signup-back-btn").removeAttribute("href");
    // document.getElementById("signup-register-btn").disabled = true;

}