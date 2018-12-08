<?php 
if(!isset($_SESSION["loginuser"])){
    header("Location: ../login.php");
    exit;
}
?>
<script type="text/javascript">
function idleTimer() {
    var t;
    //window.onload = resetTimer;
    window.onmousemove = resetTimer; // catches mouse movements
    window.onmousedown = resetTimer; // catches mouse movements
    window.onclick = resetTimer;     // catches mouse clicks
    window.onscroll = resetTimer;    // catches scrolling
    window.onkeypress = resetTimer;  //catches keyboard actions

    function logout() {
        // swal('Auto LogOut !','Your session has Expired after 15 minutes inactivity !','warning').then(function(){
        //         window.location.href = '../logout.php';
            // });
        window.location.href = '/IDRS/logout.php';  //Adapt to actual logout script
    }

   function reload() {
          window.location = self.location.href;  //Reloads the current page
   }

   function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 18000000);  // time is in milliseconds (1000 is 1 second)
        // t= setTimeout(reload, 300000);  // time is in milliseconds (1000 is 1 second)
    }
}
</script>