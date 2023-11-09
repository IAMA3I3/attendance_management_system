const popUp = document.querySelectorAll("#pop-up");

const fade = () => {
    popUp.forEach(item => {
        item.classList.add("swipe-off")
    });
}

const disappear = () => {
    popUp.forEach(item => {
        item.style.display = "none"
    })
}

setTimeout(fade, 3000)
setTimeout(disappear, 3500)