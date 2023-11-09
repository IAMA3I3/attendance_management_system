const form = document.querySelector(".pop-form-container")
const popBtn = document.querySelector("#pop-btn")
const closeBtn = document.querySelector(".close")

popBtn.addEventListener("click", () => {
    form.classList.add("pop")
})

closeBtn.addEventListener("click", () => {
    form.classList.remove("pop")
})