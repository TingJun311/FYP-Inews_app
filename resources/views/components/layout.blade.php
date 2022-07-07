<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/cover_copy.ico" />
    <link rel="stylesheet" href="css/app.css">
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inews</title>
</head>
<body>
    <header class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">        
                <!-- Mobile toggle button -->
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>

                <!-- Logo -->
                <a class="brand" href="/"><b>LOGO</b></a>
                <!-- Navigation -->
                <nav class="nav-collapse collapse">
                    <ul class="nav">
                    
                        <li><a href="#top">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mega Menu <b class="caret"></b></a>                      

                            <ul class="dropdown-menu mega-menu">
        
                                <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">Mega menu 1</li>
                                    <img src="#">
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                </ul>
                                </li>    
            
                                <li class="mega-menu-column">
                                <ul>
                                <li class="nav-header">Mega menu 2</li>
                                    <img src="#">
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                </ul>
                                </li> 

                                <li class="mega-menu-column">
                                <ul>                            
                                <li class="nav-header">Mega menu 3</li>
                                    <img src="#">
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                    <li><a href="#">Mega-menu link</a></li>
                                </ul>
                                </li> 
                                
                            </ul><!-- dropdown-menu -->
                            
                        </li><!-- /.dropdown -->
                            
                        <li><a href="#about">About Us</a></li>                                                                               
                        <li><a href="#pricing">Our Pricing</a></li> 
                        <li><a href="#team">Our Team</a></li> 
                        <li><a href="#contact">Contact</a></li>                         
                    
                    </ul><!-- /.nav -->           
                </nav><!--/.nav-collapse -->
            </div><!-- /.container -->
        </div><!-- /.nav-inner -->
    </header>
    <main>
        {{ $slot }}
    </main>
    <script src="js/app.js"></script>
</body>
</html>