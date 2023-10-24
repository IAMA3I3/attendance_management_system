const displayTime = document.querySelector("#live-time")

const refreshTime = () => {
    var time = new Date()
    displayTime.innerHTML = time.toLocaleTimeString()
}

setInterval(refreshTime, 1000)
