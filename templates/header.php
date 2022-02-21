<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Inventory System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="fas fa-home">&nbsp;</i>Home</a>
                </li>

                <?php
                if (isset($_SESSION["userid"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php"> <i class="fas fa-user">&nbsp;</i>Logout</a>
                    </li>
                <?php
                }
                ?>
                
            </ul>
        </div>
    </div>
</nav>