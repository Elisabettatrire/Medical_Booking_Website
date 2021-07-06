<html>
    <head>
        <meta charset="UTF-8">
      
       <link rel="stylesheet" type="text/css" 
             href="css/style.css" /> 
       <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
       <title>MediClinic</title>
    </head>
    <body>
        <div id ="contenitore"> 
            <div id="header"> 
                <div id="header_top"> 
                <ul>            
                <li><a href="#">AIUTO</a></li>
                <li><a href="#">CONTATTI</a></li>
                <li><a href="#">FAQ</a></li>
                </ul> 
                </div> 
                 <div id="header_top2"> 
                <ul>            
                <li><a style="text-decoration:none;" href="url">grp53@tweb.univpm.it</a></li>
                <li><a href="#"></a>+391234567890</li>
                </ul> 
                </div> 
            </div> 
            <div id="menuOr"> 
                <ul>
                    <li><a href="#">home</a></li>
                    <li><a href="../application/views/scripts/public/who.phtml">chi siamo</a></li>
                    <li><a href="#">servizi</a></li>
                    <li><a href="#">dottori</a></li>                         
                    <form style="padding-top: 10px;padding-right:10px;">
                        <input type="search" id="searchbar" placeholder="Cerca nel sito.." size="30">

                             <button id="searchbutton" type="submit" style="display:inline;" >
                                 <i class="fa fa-search"></i>
                             </button>
                    </form>
                </ul> 
            </div>
            <div id="secondaColonna">
                <div id="home_content">
                <div id="home_title">MEDICLINIC: <br>LA SALUTE A PORTATA DI CLICK.</div> 
                    <hr color="white" size="2" style="width: 630px; margin-left: 60px; margin-top: -15px;">
                    <div id="home_text">Accedi subito per prenotare<br> una visita, o  clicca su SERVIZI <br> per ricevere maggiori<br> informazioni sulle nostre attività.</div>
                </div>
               <input type="button" name="Submit3" value="LOGIN" onclick="location.href='../application/views/scripts/public/login.phtml'" id="servicebutton"/>              
                </div>
        
            <div id="footer">
                <div class="box0">
                    <div class="box0_img">
                        
                    </div>
                     <div class="box0_text">
                        Copyright © 2018 Gruppo 53.<br> All rights reserved.
                    </div>
                </div>
                <div class="box1">
                   <div id="mappafooter" style="text-align: center">
                       <div class="mappa_footer_text">
                           Via Breccie bianche 23, Ancona (AN).
                           </div>
                   </div> 
                    </div>
                <div class="box2">
                   <table id="tabellaorari"
                          cellspacing="15"
                          cellpadding="1"style="text-align: center" >
                                     
                        <tr>
                          <th width="auto" colspan="2">Orari di apertura</th>
                        </tr> 
                            <td>Luned&iacute;</td>     
                            <td>08:00-20.00</td>  
                        <tr>
                            <td>Marted&iacute;</td>    
                            <td>08:00-20.00</td>
                        </tr>
                        <tr>
                            <td>Mercoled&iacute;</td>   
                            <td>08:00-20.00</td>
                        </tr>
                        <tr>
                            <td>Gioved&iacute;</td>   
                            <td>08:00-20.00</td>
                        </tr>
                        <tr>
                            <td>Venerd&iacute;</td>   
                            <td>08:00-20:00</td>
                        </tr>
                      </table>
                </div>
            </div> 
        </div>
    </body>