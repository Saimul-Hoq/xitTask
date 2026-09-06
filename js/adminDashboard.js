function setProfileButtonsDisabled(disabled) {
    document.querySelector("#profile-editPassword-btn").disabled = disabled;
}


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
if(currentEditForm === "password"){
    document.querySelector(".profile-block").classList.add("closeProfileBlock");
    document.querySelector("#editPassword-form").classList.add("openEditForm");
    setProfileButtonsDisabled(true);
}