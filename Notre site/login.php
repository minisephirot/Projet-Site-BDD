<?php
session_start();
include "fonction.php";
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login to Like & Share</title>
		<link href="css/stylelogin.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		
    </head>
    <body>
      
        <div class="container">
           
            <header>
            </header>
            <section>				
                <div id="container_demo">
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="connection.php" autocomplete="on" method="post"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" > Nom d'utilisateur </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="ex : JugeDuBonGoutdu54"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd"> Mot de passe </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="ex : 42" /> 
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Rester connecter</label>
								</p>
                                <p class="login button"> 
                                   <a href="http://cookingfoodsworld.blogspot.in/" target="_blank" ></a>
								</p>
								<input type="submit" value="OK"/> 
                                <p class="change_link">
									Pas encore membre ?
									<a href="#toregister" class="to_register">S'inscrire</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="inscription.php" autocomplete="on" method="post"> 
                                <h1> Inscription </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" >Nom d'utilisateur</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="JugeDuBonGoutdu54" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail"  > Votre e-mail</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="test123@hotmail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" >Mot de passe </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="42"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" >Votre tranche d'age</label>
				    <SELECT name="age" size="1">
					  <OPTION>0-20
					  <OPTION>21-30
					  <OPTION>31-101
				    </SELECT>
                                </p>
                                <p> 
                                    <label for="code_postal" class="code_postal" >Entrez votre code postal (5 chiffres)</label>
                                    <input id="code_postal" name="code_postal" required="required" type="code_postal" placeholder=""/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="OK"/> 
								</p>
                                <p class="change_link">  
									Déjà membre  ?
									<a href="#tologin" class="to_register"> Se connecter </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>