<?php
class LoginView{
    
    public static function draw(){
        $html = '
        
        <body>
        <form action="'.URL.'/ui" method="POST">  
                <div class="container">   
                    <h3>Password  </h3>   <br>
                    <input type="password" placeholder="enter password" name="password" required>  
        			<br>
        			<br>
                    <button type="submit">Enter</button>   
                </div>   
            </form>     
        </body>


';
        
       echo $html; 
    }
    
    
}