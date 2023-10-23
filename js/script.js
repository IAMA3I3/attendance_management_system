const timeInput = document.querySelector("#clockin-time")

const refreshTime = () => {
    var time = new Date()
    timeInput.value = `${time.getHours()} : ${time.getMinutes()} : ${time.getSeconds()}`
}

setInterval(refreshTime, 1000)
