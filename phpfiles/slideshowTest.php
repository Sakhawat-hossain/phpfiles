<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            * {box-sizing:border-box}

            /* Slideshow container */
            .slideshow-container {
              max-width: 700px;
              position: relative;
              margin: auto;
                border-style: solid;
                border-width: 2px;
                border-left-color: black;
            }

            .mySlides {
                display: none;
            }
            
            img{
                height: 70%;
                width: 50%;
            }

            /* Next & previous buttons */
            .prev, .next {
              cursor: pointer;
              position: absolute;
              top: 50%;
              width: auto;
              margin-top: -22px;
              padding: 16px;
              color: royalblue;
              font-weight: bold;
              font-size: 18px;
              transition: 0.6s ease;
              border-radius: 0 3px 3px 0;
            }

            /* Position the "next button" to the right */
            .next {
              right: 0;
              border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover, .next:hover {
              background-color: rgba(0,0,0,0.8);
            }

            /* Caption text */
            .text {
              color: black;
              font-size: 15px;
              padding: 8px 12px;
              position: absolute;
              bottom: 8px;
              width: 100%;
              text-align: center;
            }

            /* Number text (1/3 etc) */
            .numbertext {
              color: black;
              font-size: 12px;
              padding: 8px 12px;
              position: absolute;
              top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
              cursor:pointer;
              height: 15px;
              width: 15px;
              margin: 0 2px;
              background-color: #bbb;
              border-radius: 50%;
              display: inline-block;
              transition: background-color 0.6s ease;
            }

            .active, .dot:hover {
              background-color: #717171;
            }

            /* Fading animation */
            .fade {
              -webkit-animation-name: fade;
              -webkit-animation-duration: 1.5s;
              animation-name: fade;
              animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
              from {opacity: .4} 
              to {opacity: 1}
            }

            @keyframes fade {
              from {opacity: .4} 
              to {opacity: 1}
            }
        </style>
    </head>
    <body>
        <h2>Slideshow</h2>
       

        <div class="slideshow-container">

            <div class="mySlides ">
              <div class="numbertext">1 / 3</div>
              <img src="Images/Slide1.PNG" alt="Image not found ! " style="width:100%">
              <div class="text">ddddddddd</div>
            </div>

            <div class="mySlides">
              <div class="numbertext">2 / 3</div>
              <img src="Images/Slide2.PNG" alt="Image 2 not found ! " style="width:100%">
              <div class="text">eeeeeee</div>
            </div>

            <div class="mySlides">
              <div class="numbertext">3 / 3</div>
              <img src="Images/Slide3.PNG" alt="Image 3 not found ! " style="width:100%">
              <div class="text">tttttt</div>
            </div>
            
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(+1)">&#10095;</a>

        </div>
        <br>

        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>
        
       
        
        <script>
            
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
              showSlides(slideIndex += n);
            }

            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("dot");
              if (n > slides.length) {slideIndex = 1}    
              if (n < 1) {slideIndex = slides.length}
              for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";  
              }
              for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
            }
           /* var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                   slides[i].style.display = "none";  
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}    
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";  
                dots[slideIndex-1].className += " active";
                setTimeout(showSlides, 2000); // Change image every 2 seconds
            }*/
            
        
       /*     $slideIndex = 0;
            showSlides();

            function showSlides() {
                
                $slides = document.getElementsByClassName("mySlides");
                $dots = document.getElementsByClassName("dot");
                for ($i = 0; $i < $slides->length; $i++) {
                   $slides[$i].style.display = "none";  
                }
                $slideIndex++;
                if ($slideIndex > $slides.length) {$slideIndex = 1}    
                for ($i = 0; $i < $dots.length; $i++) {
                    $dots[$i].className = $dots[$i].className.replace(" active", "");
                }
                $slides[$slideIndex-1].style.display = "block";  
                $dots[$slideIndex-1].className += " active";
                setTimeout($showSlides, 2000); // Change image every 2 seconds
            }*/
        </script>
        
    </body>
</html>