<?php
 
session_start();
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        $_SESSION['room'] = stripslashes(htmlspecialchars($_POST['room']));
        $_SESSION['avatar'] = stripslashes(htmlspecialchars($_POST['emoji']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
 
function oldloginForm(){
    echo
    '<div id="loginform">
    <p>Please enter your name to continue!</p>
    <form action="index.php" method="post">
      <label for="name">Name &mdash;</label>
      <input type="text" name="name" id="name" /><br>
      <label for="room">Select a Room to Join</label>
					<select name="room" id="room">
						<option value="Open Chat">Open Chat</option>
						<option value="Yoga Group">Yoga Group</option>
						<option value="Pub Trivia">Pub Trivia</option>

					</select>
                    <label for="room">Choose your Avatar</label>
                    <input 
                    type="radio" name="emoji" 
                    id="sad" class="input-hidden" value="avatar.png" />
                  <label for="sad">
                    <img 
                      src="img/avatar.png" 
                      />
                  </label>
                  
                  <input 
                    type="radio" name="emoji"
                    id="happy" class="input-hidden" value="avatar2.png"/>
                  <label for="happy">
                    <img 
                    src="img/avatar2.png" 
                       />
                  </label>
      <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
  </div>';
}

function loginForm(){
    echo
    '
    <!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
		integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/style.css" />
	<title>ChatCord App</title>
</head>

<body>

	

	<div id="shift" class="join-container">
		<header class="join-header">
			<h1><i class="fas fa-smile"></i>Employee Engagement</h1>
		</header>
		<main class="join-main">
			<form action="index.php" method="post">
				<div class="form-control">
					<label for="username">Username</label>
					<input type="text" name="name" id="name" placeholder="Enter username..." required />
				</div>
				<div class="form-control">
					<label for="room">Select a Room to Join</label>
					<select name="room" id="room">
						<option value="Open Chat">Open Chat</option>
						<option value="Yoga Group">Yoga Group</option>
						<option value="Pub Trivia">Pub Trivia</option>
                

					</select>
                </div>
 
                <div class="form-control">
					<label id="avatar" for="avatar">Choose an Avatar</label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar.png" />
                    <label for="sad"> <img src="img/avatar.png" style="width:50px;" /> </label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar2.png" />
                    <label for="sad"> <img src="img/avatar2.png" style="width:50px;" /> </label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar3.png" />
                    <label for="sad"> <img src="img/avatar3.png" style="width:50px;" /> </label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar4.jpg" />
                    <label for="sad"> <img src="img/avatar4.jpg" style="width:50px;" /> </label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar5.jpg" />
                    <label for="sad"> <img src="img/avatar5.jpg" style="width:50px;" /> </label>

                    <input type="radio" name="emoji" id="sad" class="input-hidden" value="avatar6.jpg" />
                    <label for="sad"> <img src="img/avatar6.jpg" style="width:50px;" /> </label>


				</div>
				<button type="submit" name="enter" class="btn">Join Chat</button>
			</form>
		</main>
	</div>

</body>

</html>
    ';

}


 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>ChatApp</title>
        <meta name="description" content="Chat Application" />

    </head>
    <body>
    <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
        

        <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">
  <title>ChatApp</title>
</head>

<body>


  <div class="chat-container">
    <header class="chat-header">
      <h1><i class="fas fa-smile"></i> ChatCord</h1>
      <a id="exit" href="#" class="btn">Leave Room</a>
    </header>
    <main class="chat-main">
      <div class="chat-sidebar">
        <h2><i class="fas fa-comments"></i> Room Name:</h2>
        <h3 id="room-name"><?php echo $_SESSION['room']; ?></h3>
        <h3><i class="fas fa-users"></i> Users</h3>
        <h4><?php echo $_SESSION['name']; ?> <img width="10%" src="img/<?php echo $_SESSION['avatar'];?>"></h4>
      </div>
      <div class="chat-messages" id="chatbox">
      <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
      
      </div>
    </main>
    <div class="chat-form-container">
      <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" placeholder="Enter Message" required autocomplete="off" />
        <button class="btn" name="submitmsg" type="submit" id="submitmsg"><i class="fas fa-paper-plane"></i> Send</button>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
 
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
</body>

</html>
       
<?php
}
?>
