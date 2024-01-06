<?php

include_once "php/config.php";

$users_query = mysqli_query($conn, "SELECT COUNT(*) AS user_count FROM users");
$user_count = ($users_query) ? mysqli_fetch_assoc($users_query)['user_count'] : 0;


$posts_query = mysqli_query($conn, "SELECT COUNT(*) AS post_count FROM posts");
$post_count = ($posts_query) ? mysqli_fetch_assoc($posts_query)['post_count'] : 0;

function getRandomNumber() {
    return rand(1, 5);
}

$randomNumber = getRandomNumber();
?>
<?php include_once "header.php"; ?>
<html lang="en">
<style>
    html{
  scroll-behavior: smooth;
}

    body{
        margin: 0;
        background: #020824;
    }

    
    .container nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    background: transparent;
    top: 0;
    width: 100%;
    padding: 10px; /* Add your desired padding */
    z-index: 1000;
    background: url(img/background.jpg)
    no-repeat center;
    background-size: cover;
}

.container nav a {
    text-decoration: none;
    color: white;
}

.container .btn {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
}

.container .menu-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.container .menu {
    list-style: none;
    display: flex;
    gap: 20px;
}

  
</style>
<body class="index">
    <header>
        <div class="container" id='home'>
            <nav>
                <a href="index.php" class="brand">T&L</a>
                <ul class="menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#art">ArtWorks</a></li>
                    <li><a href="#Artists">Artists</a></li>
                    
                    <li>
                        <a href="login.php" class='btn btn-primary'>
                            Log In
                        </a>
                    </li>
                </ul>
                <a href="login.php" class='btn btn-primary'>
                    Log In
                </a>
                <button class='menu-btn'>
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
            <div class="header-body" >
                <div>
                    <div>
                        <p>
                            Every tree in the forest knows About
                            creating value and about reciprocity
                        </p>
                        <span class="bar"></span>
                        <h1>Buy ART's</h1>
                    </div>
                    <div>
                        <h1>Sell ART's</h1>
                        <span class="bar"></span>
                        <p>
                            Every tree in the forest knows about
                            creating value and about reciprocity
                        </p>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary">
                            Join Us
                        </a>
                        <a href="#" class="btn btn-secondary">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            <img src="img/grid1-top.png" class="grid-img" alt="">
        </div>
    </header>

    <div class="container">
        <img src="img/grid1-bottom.png" alt="" class="grid-img">
        <section class="services">
            <div class="heading" id="about">
                <h2>What we actually do?</h2>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, veniam enim? Nostrum veritatis
                    iusto neque, repudiandae doloribus ut nobis repellendus!
                </p>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="light"></div>
                    <img src="img/wallet.png" alt="wallet" >
                    <h3>Set up your wallet</h3>
                    <p>
                        ART's ate transforming the way commerce is transacted
                    </p>
                </div>
                <div class="card">
                    <div class="light"></div>
                    <img src="img/camera.png" alt="camera" >
                    <h3>Set up your wallet</h3>
                    <p>
                    ART's ate transforming the way commerce is transacted
                    </p>
                </div>
                <div class="card">
                    <div class="light"></div>
                    <img src="img/gift.png" alt="gift">
                    <h3>Set up your wallet</h3>
                    <p>
                    ART's ate transforming the way commerce is transacted
                    </p>
                </div>
            </div>
        </section>

        <section class="featured">
            <div class="heading" id='art'>
                <h2>Featured Artworks</h2>
            </div>
            <div class="cards">
                <div class="card">
                    <img class ="art-img" src="img/crystal1.jpg" >
                    <div class="light"></div>
                    <h3 class="art-title">Blue Color Crystal</h3>
                    <div class="favourites">
                    <div>
                    <img src="img/user1.jpg" alt="artwork">
                    <img src="img/user2.jpg" alt="artwork">
                    <img src="img/user3.jpg" alt="artwork">
                  
                    <small>
                    2+
                    </small>
                </div>
                        <div>
                            <span>Favourite This</span>
                        </div>
                    </div>
                    <div class="bid">
                        <div>
                            <p>
                                Current Bid
                            </p>
                            <h3>
                                <i class="fab-fa-ethereum"></i>
                                2.65ETH
                            </h3>
                        </div>
                        
                    </div>
                </div>
                <div class="card">
                    <img class ="art-img" src="img/crystal2.jpg" >
                    <div class="light"></div>
                    <h3 class="art-title">Orange Color Crystal</h3>
                    <div class="favourites">
                    <div>
                    <img src="img/user1.jpg" alt="artwork">
                     <img src="img/user2.jpg" alt="artwork">
                      <img src="img/user3.jpg" alt="artwork">
                    <small>
                    2+
                    </small>
                </div>
                        <div>
                            <span>Favourite This</span>
                        </div>
                    </div>
                    <div class="bid">
                        <div>
                            <p>
                                Current Bid
                            </p>
                            <h3>
                                <i class="fab-fa-ethereum"></i>
                                2.65ETH
                            </h3>
                        </div>
                       
                    </div>
                </div>
                <div class="card">
                    <img class ="art-img" src="img/crystal3.jpg" >
                    <div class="light"></div>
                    <h3 class="art-title">Green Color Crystal</h3>
                    <div class="favourites">
                    <div>
                    <img src="img/user1.jpg" alt="artwork">
                     <img src="img/user2.jpg" alt="artwork">
                      <img src="img/user3.jpg" alt="artwork">
                
                    <small>
                    2+
                    </small>
                </div>
                        <div>
                            <span>Favourite This</span>
                        </div>
                    </div>
                    <div class="bid">
                        <div>
                            <p>
                                Current Bid
                            </p>
                            <h3>
                                <i class="fab-fa-ethereum"></i>
                                2.65ETH
                            </h3>
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>

        <section class="explore">
            <div class="grid">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div>
                <h2>Explore our top art works</h2>
                <p>
                ART's ate transforming the way commerce is transacted, contracts are enforced, investment are held, and value is transerred.
                    Every tree in the forest knows about creating value and value is transferred every tout reciprocity.
                </p>
                <div class="stats">
        <div>
            <small>Artworks</small>
            <h3><?php echo $post_count; ?></h3>
            <p>ART's are transforming the way commerce</p>
        </div>
        <div>
            <small>Users</small>
            <h3><?php echo $user_count; ?></h3>
            <p>ART's are transforming the way commerce</p>
        </div>
    </div>
                </div>
        </section>

        <section class="artists" id="Artists">
            <div class="heading">
                <h2>Our top artists</h2>
                <p>
                ART's ate transforming the way commerce is transacted, contracts are enforced, investment are held, and value is transerred.
                    Every tree in the forest knows about creating value and value is transferred every tout reciprocity.
                </p>
            </div>
            <div class="cards">
                <div class="card">
                    <img src="img/smokes1.jpg" alt="bg-img" class="bg-img">
                    <img src="img/Tarek.jpg" alt="profile-img" class="profile-img">
                    <h3>Tarek Semhan</h3>
                    <div class="stars" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                        <span>
                            5.0
                        </span>
                    </div>
                    <p>
                    ART's are transforming the way commerce
                    </p>
                    <button class="card-btn">Follow</button>
                </div>
                <div class="card">
                    <img src="img/smokes2.jpg" alt="bg-img" class="bg-img">
                    <img src="img/Layal.png" alt="profile-img" class="profile-img">
                    <h3>Layal Faraj</h3>
                    <div class="stars" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                        <span>
                            5.0
                        </span>
                    </div>
                    <p>
                    ART's are transforming the way commerce
                    </p>
                    <button class="card-btn">Follow</button>
                </div>
            </div>
        </section>
    </div>

    <section class="trial">
    <h2>Unlock the NFT Experience</h2>
<p>
ART's are transforming the way commerce is transacted, contracts are enforced, investments are held, and value is transferred.
    Every tree in the forest knows about creating value and value is transferred at every touchpoint of reciprocity.
</p>
<a href="#" class="btn btn-primary">
    Explore Now
</a>

        </section>
        <div class="container">
            <footer>
                <div>
                    <h2>Degital Agency</h2>
                    <p>
                    ART's are transforming the way commerce
                    </p>
                    <hr>
                    <h3>Get pur latest updates</h3>
                    <form action="">
                        <div class="input-wrap">
                            <input type="email"
                            placeholder="Enter Your Email">
                            <button class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
                <div>
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">reg</a></li>
                        <li><a href="#">gf</a></li>
                        <li><a href="#">df</a></li>
                        <li><a href="#">fd</a></li>
                        <li><a href="#">df</a></li>
                        <li><a href="#">df</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Informations</h3>
                    <ul>
                    <li><a href="#">reg</a></li>
                    <li><a href="#">gf</a></li>
                    <li><a href="#">df</a></li>
                    <li><a href="#">fd</a></li>
                    <li><a href="#">df</a></li>
                    <li><a href="#">df</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Company</h3>
                    <li><a href="#">reg</a></li>
                    <li><a href="#">gf</a></li>
                    <li><a href="#">df</a></li>
                    <li><a href="#">fd</a></li>
                    <li><a href="#">df</a></li>
                    <li><a href="#">df</a></li>
                </div>
                <div>
                    <h3>Socail Media</h3>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Linkedin</a></li>
                        <li><a href="#">Whatsapp</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Telegram</a></li>
                    </ul>
                </div>
            </footer>
        </div>
</body>
<script src="javascript/index.js"></script>




</html>