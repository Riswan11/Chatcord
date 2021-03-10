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

  <!-- Image and text -->
	<nav id="navbarHeader" class="navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="data:image/png;base64,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"
					alt="" width="120" height="" class="d-inline-block align-top">
				<span id="labs">Innovation Labs</span>
			</a>
		</div>
	</nav>
	

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

      <!-- Image and text -->
	<nav id="navbarHeader" class="navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAf0AAABjCAMAAACmCSk9AAAA4VBMVEX///8hIF/uMSQAAFQAAFDl5e0fHl4SEVkODVj6+vyursIZGFzi4ullZIrs7PG8vM0mJWZ8fJlWVX1wcJSdnbIIBlcHBVY9PG1qaYxfX4ujo7aNjaU+PXO4uMbCws2SkqzJydiGhaUvLmxXVn3+6ujtJBJQUH4xMWf+8fBKSn3tGQAaGVvuKhztIA0AAFcWFFr2npnX1+H84uH6yMX70c/vRTrvOCv0iIL4sq7xWE/zfHX5vrvwT0TOztryZV3zdGz3p6T2lY/wU0sAAEnzamLzgHr72thIR3TydG6WlqtycpHXPdDWAAARSUlEQVR4nO2d+0OqPBjHZ0M2RFFTvHKOlxNqgi4ryy6eS6dTp/7/P+iFUhiwAUqlnZfvTwoDBh+e7dn2bACQKlWqVKlSvZFGo6Ojo9Pzs7PzB+vHaLTr/KT6KI3OFpffL8zJeKWJeXF1+fPsaNf5SvXOGp3eXM8PTF03Dzx62TL/cfOQFgL/rI5O7g/Gpg889QqYY/P7SVoE/Isa3VxZZTyPvFsIjK9u0gLgH9Po1100+tULMLk7Sfn/Qxr9vIjL/pX/wc+U/z+i0WLu9/KiK4D5IuX/L+gsdpnvtf/bs13nPFVSja5D2JsmvwVg8f+R+v+fW2e3Ogu6bstq4c9v5xfrP0Hp85td5z/V9hpdjgNUrTbd/O/J4pyy69Ozn5ffD8bBN8AcX6e1/2fVw/dJwJzNq1/nR1Iw7ejo/Nf3g0BBoV+df3y+U72Bzvw1vjnRL0NdufNfB4Fjxmnp/xl14vfo9NvobtzR4spfAei/PiK3qd5Uv7ylvt2DE8uFHy3mPmdhcvneeU31tpJ+eOHr8xNuUsW/ZXHrPXhyn/p+n0rXHv/N1H+c8lJ2D78Eth398Rb/+o93zWyqt9X12Ou4c329bkEQgvQt/8/bXJj8YDQTUu2nLr2W/4dXcOefDZKZsuhb5/Ba//X75TbVm2pBWz6/yZZtq0jM8OiDG4/zN/75XrlN9aa6oamZd5zuGqXTxxZ7Pn3wcEUXIXra7v8MOrqg6OtzjruXq8MX9pkM5NEHR3cUfvOA6zim2htJ9xSyyQ9ela+hzEpc27fO9Zfy/czbtN239zqhgXHhg2MjBn0wuqbKkbTXZ/91RIufLB792KdL9akUl36qf1Ep/f+zUvr/Z6X0/89K6f+fldL/Pyul/2klKbNqr3JoafCt0ilmGcOvkuKK2iopki1FcumrOWejJEWeIdVba/2cY46hL6vNEqxhIhuWZKJCXHjK+hN1+5ojd2fueLBSaQ0/I9YHrqjz9JwzDAuReRotFnGm/pwv1hPEZrkwLVfpi7lcxENZrlNku3H0+h5L7hV4spLk3X/dQA6L3RnbJsJvrOtP3SoflmSsyvJxs52bRWQKKLmhjImYoSUSLDd9t1OExlqiexstZyt9uJOSZKjrl/F6MzqMyhUAt+N5dFfg6Go8X/2sCpgv2FulakLnJ0dtASqrWyM+ybLs36QWX9Iqv2EnIqvKb+Gr+68BMfJmEclGpl/I5QMvZ/iNVTzX+DI0sApXUlUs93uzsLe9qkEjw5BISNlj/0Xo7CpR9DHrYPcsJZq+Mw4kx6B/MplEG/+DOVkHCFdr4hTyJJRXqZpEFMMNoq2SV/rV3/6zGKIcOPGKvoAj6QuQol8hRiCTWEUYio2i78BWTVQDaZ3r06XocgCtgvu411pa+tIp9KGKa3Kly8tSrsRm/0IOTXNU0o+mf6qb95GJLnV9PUxcVeEsy9W6UG3KGTIILfsd+lLgHHVUyPs3vp5rc/r40ZPbWbFYbLUrGkRIGHhfz5YKu9E3ZuW3I8jTgqdiU3LPJRUJ/mJ8tdMqi0PZkYp7ro+mL92bemSiC92JDq6qQgxfsimLIsyFpWhjwjtPHTc4L87m9NUB4yqW813oI9L3ZLBVEwJOGEs9bPRbgfzleyWESp1gvvNDNRSdJdh08vjR9MFCnywikpzpk5/r3zHpE61kDPMhKRzbD+rd6dvKVqYyblEbYtJvCbLGvK98B6pa4GLdPomCn8mQ4/VxH07/yNT/RCT5pU+c+KCY9NFxDqNGSIpd07eqY8OYUmV1PPpL0dB4Ds0yWPQv5dBSfy3UXN3wh9MHV+ZFuNc/ujVvnT9x6WtKBQtdford0wdVTA7dC8Wj30TQ7y6GqMuo8kVb/o3qyqv8ePo3k3F40X82puqG+PSzffLIT7rLet/Zi6Yuylj0s4LMyxsrtSb7QMlOG1Km3wBx3ZDl0Hcao9RBxDmVShLQP52b30MTXOsXbmBofPpWS17ls9oD2wczIg+cP7HoP6kkfv+6NEAZWiLGh51W12rPLHNPTUShxOvuBDb9ZftpJbevT248uaLucVP64A9NN6jRXP/r/tuAvtQkkNvo3wfbB89IdojHom892/im/+SgfEU87OWphmO+11/zJ8frk7Lpu+o7bwxvlGdj+jdjPazovzHpmmED+mCpkgLvYe2D7VttfNkp+uPQVwboOCqNo1mfLtwNtefPSb4jvLgFVONoB/TB2LwPeaP/6GNq7yb0QQ9yG/17YfsziJxGXxz6WQ0NotI4atJtPVn7ykjSfcR2heA2FXZB/1of873+kUkX/JvRVx7JkPNI98L2JYjb69+x6A9DW7EezQQKPimxs6EUYGb65P7fBf0zfcJdJcCuF+i5YBvRB0UBl9kp9sL2gYCe15eKZ/sktu1XKJePcHMh9X5T8HdCf3SnX3F33uu3dMGwGX1QQJxG/17Y/qb0lQGpR6VZKV9ya30R8Xs9JU+v8S7o214/b4mv07l3EviG9Gd9zmjPntg+dgai49CXnnEmZsRMjnL45ditxJ3QPx9zi/7FZOx5MTakD6pwygS2F7YvQbW6/h2zvY9Cx65cDdyOHhIdZLPWTuhLc3PO2XVlzj1zCjelLw3IlHUfe2H7eYg38vntvr7DWA1+JeNwEvmdHgHthD440ccPzB2jsW/ht03pg6WMWI3+vbD9nEo2au9bfgyOjC56UdFt7tHj95GH7YT+OW91v5+TA2/oz8b0QVlVGaXlXth+G4vO7nj085qMGKP4AbkDM2LcusLWbuiDW/OKOWn8XvdVCZvTzw7lUvB57YPtKxpxu+5iju8voQHL0fh7Lv1MrKCRV+2I/slEZ3n9DwcTX5mwOX3rlhiN/n2w/SpU3bRxY3uWfYLVqIhlqeGU/IYW56wr7Yj+w0RnrfFwMvH7A1vQBwOEAnEPe2D7+T7dCxOXPpgdqwb+1g1NQ027IJXQlF7tiP6IHd4317/7KgSLfoxqz0vfavTX/Qft3vaVgWcI0qIfd/JLta8iQWuF1Skupsgc09oRffBTZ0R2P+i6vx+gWjMOv3k1CNqMlz7oQFT1pdi57c8GxHOyVs0YuPdk3+MhNzhFKQ9rslovc4P4FbenLzy41add0T/VGUX/CRXQt1JVzWDVo5oQzKePPhgS4ntFdmz72SdMBE8naytwY+pvflWQfzIgwvAwxxm9+WT07W4d/0Df6IoK6FupWiONZ68awSfgp780sG9w7MPoB0+l5IuVDFLrXiytmlzw3VghtJ8w962ECc5UWAXAp6O/GI/9Rf/DJLjS5zb1PrCnVSBvNOQHlfy4nitSqlar7edBH2Io9HyGvUG9v5I0K0OrAECFbjAXn43+6Vz3T+phhXxt4/MD2w2Spx6kH2T7xIACJWjPolWFUiE4HyO2z+9RsSFjywPs+nNR+lxeHwB/dV9kt3TLWOF9S/ogh9U2/f+DbJ9khl5lRFJeBudwbkvfKgAqIiak4mVFtfjQJ2jxAbvo94X3nZmMWT7b0geHSKYb/R9V7/sHZYoYseNNtqRvKV+WEfZMxvT09sSPBNwlfTD2hHDZczfHwd7frenPDEI/h121+KQCKjHH3Lanb7UgGrKMe3Sm21RP7wbuxA7p/9B1mrZ0EXAEQAL6oKPWqHlzO2vxdQX0zDowCX17ljaB9FgePcqzweSfHdKnJ2uCQEDfStvTB0OZuqPd9fY0icCaap2MPsjWSY1asKLrBndwahqmdkj/6NZj7H+Yq8QnoF+cYtcDei/bn8Eo+l2R6YglpA9mmkyNZkifKbrjVVYLzx3T8Qf0rZSAPihj7JSC72X73Uj6oIIIozBOSh8sBXpS6CFl/PG9/l3S90zXvNGZn4ZJQl9RibZ+Pu9l+zHoz6Yyww9PTB8U6FEjOqqT9bKxtUv60oV55/y51y9Y8R5J6Fu+EFw3+rezfTnSjopwGtnP/4yEII/k9Lsq9W5mh25Et8EkuT5q5xHda/1yJ/WMxswB/2T0pW+otKobt7J9qY+aEVeu1kjX/cemn8+QYGxmcvrZOqKid8vUpHt3cY6Aqr/pBUTi0+d9lycB/TPTiexeTEzm55wS0bd8svVkmK1sXxqQqEiZHulTThZnjO/Z1zljKzl9qYAf3X95gZ5sr7HPrZRVkY56jE9fbTF2g0T0wZ0TzfHXH9C3UjL6oIPga7a3sn3QQ0LElQuIHpXn0M+X5L5/W3L61ktVp67WpGfvkzrL8c8XoHemTxR9ze1AZnZaJKN/qR+8ev2nF5zVfBLSV4YrM9jK9q1yXQhvPkmPmJ47wRvf72HsN/43p58d0su2GLDjz4nSgi/9wXL8GdzuHBER0c8o79xNEvqnk1UU52LMCfBPSN9u9L/g2c72izL0Bwl5tSxhepFQHn1JNfq+HW9OH7S8qzeojx1qTV9JqdbXnoHrhUTRL7jTBKgHIeX6jruZhP7ou3nx8uNOZ0d4J6YvPSO1C7a1/Wwfha+bY7UqaHeeG9vTwf7X6A3q/W/YO8O34F1tyaihQqu4zCvZZTHXQNBwR4HDV25x9eQu/ifKr/MKst12H+LuOkUS+nYslx3ZfRoM6FspKX2QnZJHaVvbB4ckrPVkVYyySB/Lj+zSZN/KAsnp5zVfAJPy6FusTyQYlfrDYUlWPUs2i+sFjqLod6nFfkSsNQuDx6GBRaPuZD0RfQu7XfRbLwG74E9OH1RfJkNtZ/vgC8Rhyz8vIfLs5kd1tqCv4yg5/a+qP45nSQIrtonMFdvgasG+KPqzoeelkYn8UoBQ80QT0Qdzu8gf3esXnP3J6UuH9pLiW9q+Yhk3//pSA4meERw+falkIM+u5PQbaOo/w6zvX7ONKWemYxR98IxYx7szkRPSf5mx/cCf0Z2cvt3oP9zW9kEO8to6wK71fSurhER053xhHrHm74fVOnmBMZrXHcZYqdV9WJH0l0Kg3LBENYSS0X+wm3onkwNOwf8W9EHZcs2etrN9APoya1Loi7KyQbwNwhD6Sl2m+4Vi0c/J/BBNqUmCM5bsur/G4kVJpAIDIumDCmPdTnHoPq9k9O1untEdK67jVW9BX6mTx4K8Jf1ZySBsBsuhAX09YGFzeYrQM2gQg74yJbDJMX+pAVXmQL7SQ6GlvyFTk0Kj6Qc8yYw3giAh/cXk4s+FJ8zDo7egb/luluezJX2QmxqENYm6OJSxfwwojL40kH0zuSJtv6thMqyyzqhUMG5yLlU8php3frNVS3QLNZo+WMqBl4nuuUpIfzQ+MA8YAX0rbRnP71MBbU/fajTI8Ng/SNd9hrIQmFodOovzC6aNP5bXp1Qs8x+2/GCk3BBj/kiOlHvkfKEB9b1rOMagbxVxPs+PyAnW6fXr3jwIWbi3qqJyj69VyRtFP19KQN82QZlovWV29U2ybL4zMAgpBbsBw2dwDwi1UGJLJZWwG1tlqTtABJeaufy6305SZr06lqfPYTesFDWhRjwlgGggOK34+q2LAloJE66HORsIaH0q0cCCxxLKcH0GGH9hSUo3k4OQ7zVUIeF+vcb+fs3rM2nCcPqgAw3MpQ+j1sFWyoL9cZ3+oFBpNBqD4bSGsP9LKy9qwDD6XUh1zrXCb+zbOkvSF01QMVS1Qrltq1CfWn9LkTN2lOrzsQxVRF4+o4XhVCsHh+mWz2VHYRkva6pFGatQPm53Pbta7hna7IPDdTQfh6za/KVZCNOqQu4VKuH0pYKm8RAfatGLYyidAoEv39h6+WQWfmwzR38638JOJZU1dxZOxI21qfPMOgMR1vDrpE9Ug/1GvNlayqxb7RXsj+tVel9miXoXsrNcr9ypfuV8Xi6BTh94zT1gfxcyXE6qiIsoWe7dK9k4tyTNvvYag+O+NmiWc7yHEJEPJet+EDPeja0PzH+1MGb6/Yw26H1lTQ1KlSpVqlSpUqVK9W/rP1F+NPOJlqUsAAAAAElFTkSuQmCC"
					alt="" width="120" height="" class="d-inline-block align-top">
				<span id="labs">Innovation Labs</span>
			</a>
		</div>
	</nav>


  <div class="chat-container">
    <header class="chat-header">
      <h1><i class="fas fa-smile"></i> Employee Engagement</h1>
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
