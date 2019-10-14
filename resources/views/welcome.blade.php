<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/assets/css/Header-Blue.css">
        <link rel="stylesheet" href="/assets/css/Highlight-Clean.css">
        <link rel="stylesheet" href="/assets/css/Footer-Dark.css">
    </head>
    <body>
        <div>
          <div class="header-blue">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
              <div class="container"><a class="navbar-brand" href="#">FreeBook.com</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                     id="navcol-1">
                  <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation">

                    </li>
                  </ul>
                  <form class="form-inline mr-auto" target="_self">
                    <div class="form-group">
                      <label for="search-field">
                        <i class="fa fa-search"></i>
                      </label>
                      <input class="form-control search-field" type="search" id="search-field" name="search">
                    </div>
                  </form>
                  @if (Route::has('login'))
                         @auth
                            <span class="nav-item navbar-text" role="presentation">
                                <a class="btn btn-light action-button" role="button" href="{{ url('/dashboard') }}">
                                    Accede
                                </a>
                            </span>
                         @else
                              <span class="nav-item navbar-text" role="presentation" id="iniciar">
                                  <a class="login" href="{{ route('login')}}">
                                    Iniciar Sesión
                                  </a>
                              </span>
                              <span class="nav-item navbar-text" role="presentation">
                                  <a class="btn btn-light action-button" role="button" href="{{ route('register') }}" id="registrar">
                                    Regístrate
                                  </a>
                              </span>
                        @endauth
                  @endif
                </div>
              </div>
            </nav>
            <div class="container hero">
              <div class="row">
                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                  <h1>Libros a donde quiera que vayas.</h1>
                  <p>Mauris egestas tellus non ex condimentum, ac ullamcorper sapien dictum. Nam consequat neque quis sapien viverra convallis. In non tempus lorem. </p><button class="btn btn-light btn-lg action-button" type="button">Leer Mas</button></div>
                <div
                  class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                  <div class="iphone-mockup"><img class="device" src="../assets/img/iphone.svg">
                    <div class="screen"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="highlight-clean">
          <div class="container">
            <div class="intro">
              <h2 class="text-center">Libros, Libros...</h2>
              <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
            <div class="buttons">
              <a class="btn btn-primary" role="button" href="#">
                Lorem.
              </a>
              <button class="btn btn-light" type="button">
                Lorem.
              </button>
            </div>
          </div>
        </div>
        <div class="footer-dark">
          <footer>
            <div class="container">
              <div class="row">
                <div class="col-sm-6 col-md-3 item">
                  <h3>Servicios</h3>
                  <ul>
                    <li><a href="#">Lorem ipsum.</a></li>
                    <li><a href="#">Lorem ipsum.</a></li>
                    <li><a href="#">Lorem ipsum.</a></li>
                  </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                  <h3>Acerca</h3>
                  <ul>
                    <li><a href="#">Lorem.</a></li>
                    <li><a href="#">Lorem.</a></li>
                    <li><a href="#">Lorem.</a></li>
                  </ul>
                </div>
                <div class="col-md-6 item text">
                  <h3>FreeBook.com</h3>
                  <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                </div>
              </div>
              <p class="copyright">FreeBook.com © 2019</p>
            </div>
          </footer>
        </div>
    </body>
</html>
