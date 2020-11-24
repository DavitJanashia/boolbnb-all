<header id="bg-white" class="position-fixed">
      <!-- inizio primo blocco -->
      <div id="mynavbar" class=" first-block flex h">
        <!-- airbnblogo -->
        <div id="div-logo" class="mrg-t50">
          <a id="a-logo" href="{{ url('/')}}">
            <img id="logo" src="/img/pinklogo.png" alt="">
            <span id="text-pinklogo">boolbnb</span>
          </a>

        </div>

        <ul id="log-reg" class="navbar-nav ml-auto">
          @guest

            <li class="nav-item inline-block white-radius">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item inline-block white-radius">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif

          @else
            {{-- @auth --}}

              <a id="regist-1"   href="{{route('apart.create')}}" >
                <span class="text-white inv"><strong>Aggiungi un annuncio</strong></span>
              </a>
              <a id="regist-1"   href="{{route('sponsor.choose')}}" >
                <span class="inv">Sponsorizza il tuo appartamento</span>
              </a>
              {{-- @endauth --}}
              <li id="my-profile" class=" r3 mrg-r20 nav-item dropdown inline-block white-radius">
                <a id="navbarDropdown" class=" nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{-- {{ Auth::user()-> firstname }} --}}
                  <i class="fas fa-bars"></i>
                  <img id="user" src="/img/user.png" alt="">
                </a>



              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <a class="dropdown-item" href="{{ route('user.index') }}">Lista</a>
              <a id="regist-1"  class="dropdown-item"  href="{{route('apart.create')}}" >Aggiungi un annuncio</a>
              <a id="regist-1" class="dropdown-item"  href="{{route('sponsor.choose')}}" >Sponsorizza il tuo appartamento</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>

      </div>


      <!-- fine primo blocco -->
      <!-- destinazioni + check-in/check-out -->
      {{-- <div id="div-search" class="flex">
        <div class="white-radius-center">
          <input type="text" name="" id="mysearch" placeholder="Cerca appartamento">
          <div class="search">
            <a href="#"><i class="fas fa-search"></i></a>
          </div>
        </div>
      </div> --}}


    </header>
