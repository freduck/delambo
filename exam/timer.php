<style>
    #timer{
        font-size:30px;
        font-weight:bolder;
        /* color:white; */
        top:20%;
        position:fixed;
    }
</style>
<div id="timer"></div>
<script>
    
let examDuration = 900;
         let startCountdown=function () {
    let timer = setInterval(() => {
        let hours = Math.floor(examDuration / 3600);
        let minutes = Math.floor((examDuration % 3600) / 60);
        let seconds = examDuration % 60;

        // Display the countdown
        document.getElementById("timer").innerHTML = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // Check if time's up
        if (examDuration <= 0) {
            clearInterval(timer);
          location.href="result.php?subject=1";
        }

        // Decrement the exam duration
        examDuration--;
    }, 1000);
}
startCountdown();
</script>