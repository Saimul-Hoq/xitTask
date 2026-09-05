function setProfileButtonsDisabled(disabled) {
    document.querySelectorAll(".profile-block button").forEach((btn) => {
        btn.disabled = disabled;
    });
}

// Name
document.querySelector("#profile-editName-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editName-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
});

document.querySelector("#editName-cancel-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.remove("closeProfileBlock");
    document.querySelector("#editName-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
});

// Password
document.querySelector("#profile-editPassword-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editPassword-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
});

document.querySelector("#editPassword-cancel-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.remove("closeProfileBlock");
    document.querySelector("#editPassword-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
});

// Mobile
document.querySelector("#profile-editMobile-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editMobile-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
});

document.querySelector("#editMobile-cancel-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.remove("closeProfileBlock");
    document.querySelector("#editMobile-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
});

// Address
document.querySelector("#profile-editAddress-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editAddress-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
});

document.querySelector("#editAddress-cancel-btn").addEventListener("click", () => {
    document.querySelector(".profile-block").classList.remove("closeProfileBlock");
    document.querySelector("#editAddress-form").classList.remove("openEditForm");
    setProfileButtonsDisabled(false);
});

let currentEditForm = document.querySelector("#jsEditForm").textContent;
if(currentEditForm === "name"){
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editName-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "password"){
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editPassword-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "mobile"){
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editMobile-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}
if(currentEditForm === "address"){
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editAddress-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}