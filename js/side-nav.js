const sideBar = document.querySelector(".dashboard")
const menuBtn = document.querySelector("#bars")

menuBtn.addEventListener("click", () => {
    sideBar.classList.toggle("expand")
})