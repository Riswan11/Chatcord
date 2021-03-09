<?php
session_start();
if(isset($_SESSION['name'])){
    $img = $_SESSION['avatar'];
    $text = $_POST['text'];

    $text_message="
    <div class='message'>
          <p class='meta'>".$_SESSION['name']." <span>"
          .date("g:i A")."</span></p>
          <p class='text'>
          ".stripslashes(htmlspecialchars($text))."
          </p>
        </div>
    ";
     
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>