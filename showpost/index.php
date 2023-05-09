<?php include("../includes/head.php");?>
<?php 
$post_ID =$_GET["postid"];
if (isset($post_ID)) {?>

<main>
    <div id="posts" class="flex fd-col jcc aic">
        <?php 
        $result = mysqli_query($conn, "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.ID WHERE posts.Post_ID = '$post_ID' ORDER BY posts.Post_ID DESC; ");
        foreach ($result as $row) {
        ?>
        <div class="post">
            <div class="acc flex aic">
                <img src="<?php echo $row['user_avatar']?>" alt="">

                <h3> <?php echo $row['username']?> <span> am <?php echo $row['Date'];?></span>
                </h3>
            </div>
            <div class="img">
                <img src="<?php echo $row['image']?>" alt="">
            </div>
            <div class="lss-bar flex fd-col">
                <div class="flex">
                    <i class="fa-regular fa-heart like-post" id="like-post-<?php echo $row['Post_ID']; ?>"></i>
                    <i class="fa-regular fa-comment"></i>
                    <i class="fa-regular fa-paper-plane"></i>
                </div>
                <h3><span id="like-count-<?php echo $row['Post_ID']; ?>"><?php echo $row['likes']; ?></span> Likes</h3>
            </div>
            <div class="description">
                <h4><?php echo $row['username']?></h4>
                <br>
                <p><?php echo $row['Description']?></p>
            </div>
        </div>

        <?php }?>

    </div>
</main>
<?php
}else { 
?>
<main class="flex jcc aic">
    <h1 style="font-size:3em;"> Post Nicht gefunden <i class="fa-solid fa-circle-exclamation"></i></h1>
</main>
<?php }?>
<?php include("../includes/footer.php");?>