function setProfileButtonsDisabled(disabled) {
    document.querySelectorAll("#profile-block button").forEach((btn) => {
        btn.disabled = disabled;
    });
}

const profileBlock = document.getElementById("profile-block");

// Name

function openEditNameForm(e){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editName-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}

function closeEditNameForm(e){
    profileBlock.classList.remove("closeProfileBlock");
    document.getElementById("editName-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
}

// Password


function openEditPasswordForm(e){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editPassword-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}

function closeEditPasswordForm(e){
    profileBlock.classList.remove("closeProfileBlock");
    document.getElementById("editPassword-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
}

// Mobile

function openEditMobileForm(e){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editMobile-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}


function closeEditMobileForm(e){
    profileBlock.classList.remove("closeProfileBlock");
    document.getElementById("editMobile-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
}

// Address

function openEditAddressForm(e){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editAddress-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}


function closeEditAddressForm(e){
    profileBlock.classList.remove("closeProfileBlock");
    document.getElementById("editAddress-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
}

// Avatar

function openEditAvatarForm(e){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editAvatar-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}


function closeEditAvatarForm(e){
    profileBlock.classList.remove("closeProfileBlock");
    document.getElementById("editAvatar-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
}

let currentEditForm = document.querySelector("#jsEditForm").textContent;
if(currentEditForm === "name"){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editName-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "password"){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editPassword-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "mobile"){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editMobile-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "address"){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editAddress-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "avatar"){
    profileBlock.classList.add("closeProfileBlock");
    document.getElementById("editAvatar-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}