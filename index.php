<html>
    <head>
        
        <title>Index page</title>
         <meta name="viewport" content="width=device-width,initial-scale=1">
        <style>
        .slides
        {
            display:block;
            height:610px; 
            position:cover;
        }
            <?php require 'style.css';?>
        </style>   
    </head> 
         <body>
            <div> 
            <table>
                <th  style="width:55%" > </th>
                <th style="width:15%"><a class="chooser" href="login1.php">Login</a> </th>
                <th style="width:15%"> <a class="chooser" href="signup.php">Sign-up</a> </th>
                <th style="width:15%"><a class="chooser" href="about.php">About us</a></th>
                <th style="width:5%"> </th>
            </table>
            
      
             <div class="slide" style="max-width: 1300px">
                 <img class="slides" src="ss2.png" style="width: 100%"> 
                 <img class="slides" src="ss3.jpg" style="width: 100%">
                 <img class="slides" src="kss2.jpg" style="width: 100%">
                 <img class="slides" src="ss4.jpg" style="width: 100%">
                 
              
             </div>
        </div>
                <script>
             
             var myindex=0;
             slideshow();
             
             function slideshow()
             {
                 var i;
                 var x=document.getElementsByClassName("slides");
                 for(i=0;i<x.length;i++)
                 {
                     x[i].style.display='none';
                 }
                 myindex++;
                 if(myindex>x.length)
                 {
                     myindex=1;
                 }
                 x[myindex-1].style.display='block';
                 setTimeout(slideshow,2000);
             }
             
             
             
             </script>
             
             
             
</body>
</html>