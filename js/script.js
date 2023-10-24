const timeInput = document.querySelector("#clockin-time")

const refreshTime = () => {
    var time = new Date()
    timeInput.value = time.toLocaleTimeString()
}

setInterval(refreshTime, 1000)
