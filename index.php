<?php

require_once __DIR__ ."/classes/Template.php";

Template::header("SMS");
?>
    <main class="first-page-container">
        <section class="first-page-top-img"></section>
        <section class="first-page-flex-container">
     
            <div>
                <h3>IPHONE</h3>
                <img src="./Assets/iphone.jpg" alt="iphone"></div>
             
            <div>
                <h3>SAMSUNG</h3> 
                <img src="./Assets/samsung.jpg" alt="samsung"></div>
            </div>
            
            <div>
                <h3>SONY</h3>
                <img src="./Assets/sony.jpg" alt="sony"></div>
            </div>  
        </section>

      
    </main>

<?php    

Template::footer();
?>