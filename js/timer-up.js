var timerUp = document.querySelector("#timer-up")
var showTimer = document.querySelector("#show-timer")
var backForm = document.querySelector("#back-form")

var timeDiff = timerUp.innerHTML

timeDiff = timeDiff.split(':')

let now = new Date()

let setTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), ...timeDiff)

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}

const increase = () => {
    setTime.setSeconds(setTime.getSeconds() + 1)
    showTimer.innerHTML = pad(setTime.getHours()) + ":" + pad(setTime.getMinutes()) + ":" + pad(setTime.getSeconds())
}

const displayBackForm = () => {
    backForm.style.display = "block"
}

setInterval(increase, 1000)

if (setTime.getMinutes() >= 3) {
    displayBackForm()
}