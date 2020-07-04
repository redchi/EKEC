<?php

class Api{

    public static function javaServerConnect($cmd){
                $PORT = 51396; //the port on which we are connecting to the "remote" machine
                $HOST = "89.242.50.152"; //the ip of the remote machine (in this case it's the same machine)
        
//         $PORT = 1289; //the port on which we are connecting to the "remote" machine
//         $HOST = "192.168.1.19"; //the ip of the remote machine (in this case it's the same machine)
        
                $PORT = 55231; //the port on which we are connecting to the "remote" machine
                $HOST = "193.161.193.99"; //the ip of the remote machine (in this case it's the same machine)
                
                
        
        try{
            $ip = $_SERVER['REMOTE_ADDR'];
            
            // Printing the stored address
            echo "IP Address is: $ip", "<br>";
            
            
            
        $sock = socket_create(AF_INET, SOCK_STREAM, 0) //Creating a TCP socket
        or  new Exception("error: could not create socket\n");
        
        $succ = socket_connect($sock, $HOST, $PORT) //Connecting to to server using that socket
        or new Exception("error: could not connect to host\n");
        //  echo "sent ->".$cmd."<-\n";
        $text = $cmd; //the text we want to send to the server
        
        socket_write($sock, $text . "\n", strlen($text) + 1) //Writing the text to the socket
        or new Exception("error: failed to write to socket\n");
        
        $reply = socket_read($sock, 10000, PHP_NORMAL_READ) //Reading the reply from socket
        or new Exception("error: failed to read from socket\n");
        
        $output = Api::processJsonForConsole($reply);
        echo $output;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        //echo "\nyeet";
    }
    
    private static function processJsonForConsole($json){
        $jsonArr = json_decode($json);
        $responceString = $jsonArr->responce;
        $linebreakAll = $jsonArr->linebreaks;
        if(empty($linebreakAll)==false){
            $linebreaks = explode(",", $linebreakAll);
            foreach ($linebreaks as $linebreakPos) {
                if(empty($linebreakPos)==false){
                    $pos = (int)$linebreakPos;
                    $responceString[$pos]="\n";
                }              
            }         
        }
        return $responceString;
    }
}


?>