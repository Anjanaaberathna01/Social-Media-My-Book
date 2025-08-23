<!--top bar-->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap');
</style>

<br>
<div id="blue_bar" style="background: #3b5998; padding: 10px;">
    <div style="width: 800px; margin: auto; display: flex; align-items: center; justify-content: space-between;">

        <!-- Left: Website title and search bar -->
        <h1 style="color: white; font-size: 30px; margin: 0;">
            <a href="index.php" style="color:white; text-decoration:none;">NexNet</a>
            &nbsp;&nbsp;<input type="text" placeholder="Search..." id="searchBar">
        </h1>

        <!-- Right: Logout + Profile -->
        <div style="display: flex; align-items: center;">
            <a href="../login/logout.php"
                style="color: white; text-decoration: none; font-size: 14px; margin-right: 10px;">
                Log Out
            </a>
            <a href="profile.php" style="color: white; text-decoration: none; font-size: 14px; margin-right: 10px;">
                <img src="/images/profile-photo.jpg" alt="Profile Photo"
                    style="width: 40px; height: 40px; border-radius: 50%;">
            </a>
        </div>
    </div>
</div>