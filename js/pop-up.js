const popUp = document.querySelectorAll("#pop-up");

const fade = () => {
    popUp.forEach(item => {
        item.classList.add("swipe-off")
    });
}

setTimeout(fade, 3000)