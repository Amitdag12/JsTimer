<!DOCTYPE html>
<html>

<head>
 <style>
        .dot {
            height: 25px;
            width: 25px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <button id="startBTN" onclick="startTimer();">start</button>
    <button id="stopBTN" onclick="stopTimer();">stop</button>
    <h1 id="timer">

    </h1>
    <audio src="https://psyc-timer.herokuapp.com/beep-01a.wav" autostart="false" width="0" height="0" id="sound1" enablejavascript="true">
    <audio src="https://psyc-timer.herokuapp.com/double-beep.mp3" autostart="false" width="0" height="0" id="sound2" enablejavascript="true">

</body>
<script type="text/javascript">
   window.onload= function(){
       var testAmount=window.prompt("כמה שאלונים יש");
       var btn=document.getElementById("startBTN");
       for(var i=0;i<testAmount;i++){
var span =document.createElement("span");
span.id="span"+i;
span.classList.add("dot");
document.body.append(span);
       }
   }
    var interval = 1000; // ms
    var expected = Date.now() + interval;
    var seconds = 0;
    var timer;
    var stop = false;
    var testcount=0;
    function startTimer() {
        stop = false;
        timer = setTimeout(step, interval);
        seconds = 0;
        expected = Date.now() + interval;
    }

    function stopTimer() {
        stop = true;
        clearTimeout(timer);
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
        if (seconds % 900 == 0&&(seconds/60)%60!=00) {
            PlayBeep();
            document.getElementById("span"+testcount).style.backgroundColor="yellow";
        } else if (seconds % 1200 == 0) {
            PlayTwoBeep();
            document.getElementById("span"+testcount).style.backgroundColor="green";
            testcount++;
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
