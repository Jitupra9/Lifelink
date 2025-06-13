<header class="header">
    <div class="container header-container">
        <a href="index.php" class="logo">
            <i class="fas fa-heart"></i>
            <span>LifeLink</span>
        </a>
        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="index.php#features">Features</a>
            <a href="index.php#donate">Donate</a>
            <a href="index.php#emergency">Emergency</a>
            <a href="index.php#about">About</a>
        </nav>
        <div class="header-buttons">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="client/profile/profile.php" class="btn btn-outline">Profile</a>
            <?php else: ?>
                <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-outline">Sign In</a>
                <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-primary">Register</a>
            <?php endif; ?>
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<div class="mobile-menu" id="mobileMenu">
    <a href="index.php">Home</a>
    <a href="index.php#features">Features</a>
    <a href="index.php#donate">Donate</a>
    <a href="index.php#emergency">Emergency</a>
    <a href="index.php#about">About</a>
    <div class="mobile-buttons">
    <?php if (isset($_SESSION['user'])): ?>
                <a href="client/profile/profile.php" class="btn btn-outline">profile</a>
            <?php else: ?>
                <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-outline">Sign In</a>
                <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-primary">Register</a>
            <?php endif; ?>
    </div>
</div>