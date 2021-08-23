<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <button id="startBTN" onclick="startTimer();">start</button>
    <button id="stopBTN" onclick="stopTimer();">stop</button>
    <h1 id="timer">

    </h1>
    <audio src="https://psyc-timer.herokuapp.com/beep-01a.wav" autostart="false" width="0" height="0" id="sound1" enablejavascript="true">
        <audio src="https://psyc-timer.herokuapp.com/double-beep.wav" autostart="false" width="0" height="0" id="sound2" enablejavascript="true">

</body>
<script>
    var interval = 1000; // ms
    var expected = Date.now() + interval;
    var seconds = 0;
    var timer;
    var stop = false;

    function startTimer() {
        timer = setTimeout(step, interval);
        seconds = 0;
        expected = Date.now() + interval;
    }

    function startTimer() {
        stop = false;
        timer = setTimeout(step, interval);
        seconds = 0;
        expected = Date.now() + interval;
    }

    function PlayBeep() {
        var sound = document.getElementById("sound1");
        sound.play();
    }

    function PlayTwoBeep() {
        var sound = document.getElementById("sound2");
        sound.play();
    }

    function step() {
        var dt = Date.now() - expected; // the drift (positive for overshooting)
        if (dt > interval) {
            // something really bad happened. Maybe the browser (tab) was inactive?
            // possibly special handling to avoid futile "catch up" run
        }
        seconds++;
        document.getElementById("timer").textContent = ReturnTime(); // do what is to be done
        if (seconds % 900 == 0) {
            PlayBeep();
        } else if (seconds % 1200 == 0) {
            PlayTwoBeep();
        }
        expected += interval;
        if (!stop) {
            setTimeout(step, Math.max(0, interval - dt)); // take into account drift
        }

    }

    function ReturnTime() {
        var minutes = parseInt("" + seconds / 60),
            localSeconds = seconds % 60;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        localSeconds = localSeconds < 10 ? "0" + localSeconds : localSeconds;
        return minutes + ":" + localSeconds;
    }
</script>

</html>
