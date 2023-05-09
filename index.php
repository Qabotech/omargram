<?php include("./includes/head.php");
if (!isset($_SESSION["username"])) {
    header("../sys/");
    echo "<script>window.location.href = '../sys/';</script>";
    exit();
}
?>
<div class="overlay"></div>
<main class="flex aic fd-col jcc">
    <div id="stories">

        <i class="fa-solid fa-angle-left"></i>
        <div class="stories flex aic jcs">

            <?php $result = mysqli_query($conn, "SELECT * FROM stories s INNER JOIN users u ON s.user_id = u.ID ORDER BY u.ID DESC; ");
            foreach ($result as $row) { ?>
            <div class="story flex aic jcc fd-col s-id<?php echo $row["ID"] ?>">
                <div class="img">
                    <img src="<?php echo $row["image"] ?>">
                </div>
                <div class="text">
                    <div class="acc flex aic"
                        onclick="window.location.href = '../showuser/?user_id='+<?php echo $row['ID'] ?>">
                        <img src="<?php echo $row["user_avatar"] ?>" alt="">
                        <h4>
                            <?php echo $row["username"] ?>
                        </h4>
                    </div>
                    <div class="description">
                        <p>
                            <?php echo $row["text"] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
        <i class="fa-solid fa-angle-right"></i>
    </div>

    <div id="posts" class="flex fd-col jcc aic">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.ID Order BY posts.Post_ID DESC ; ");
        foreach ($result as $row) {
            ?>
        <div class="post">
            <div class="acc flex aic" onclick="window.location.href = '../showuser/?user_id='+<?php echo $row['ID'] ?>">
                <img src="<?php echo $row['user_avatar'] ?>" alt="">

                <h3>
                    <?php echo $row['username'] ?> <span> am
                        <?php echo $row['Date']; ?>
                    </span>
                </h3>
            </div>
            <div class="img">
                <img src="<?php echo $row['image'] ?>" alt="">
            </div>
            <div class="lss-bar flex fd-col">
                <div class="flex">
                    <i class="fa-regular fa-heart like-post" id="like-post-<?php echo $row['Post_ID']; ?>"></i>
                    <i class="fa-regular fa-comment"
                        onclick="toggleShow('#comment-form-<?php echo $row['Post_ID']; ?>')"></i>
                    <i class="fa-regular fa-paper-plane"
                        onclick="copyToClipboard(window.location.href +'/showpost/?postid='+<?php echo $row['Post_ID']; ?>),window.location.href = '../showpost/?postid='+<?php echo $row['Post_ID']; ?>"></i>
                </div>
                <h3><span id="like-count-<?php echo $row['Post_ID']; ?>"><?php echo $row['likes']; ?></span> Likes</h3>
            </div>
            <div class="description">
                <h4>
                    <?php echo $row['username'] ?>
                </h4>
                <br>
                <p>
                    <?php echo $row['Description'] ?>
                </p>
            </div>
            <div class="comments">
                <form action="../actions/comment.php" method="post" class="comment-form"
                    id="comment-form-<?php echo $row['Post_ID']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['ID']; ?>">
                    <input type="hidden" name="post_id" value="<?php echo $row['Post_ID']; ?>">
                    <textarea type="text" name="comment" id="comment-area" placeholder="Kommentiere.."></textarea>
                    <input type="submit" value="Kommentiere" name="send">
                </form>
            </div>
            <div class="comments-wrap">
                <?php $post_id = $row['Post_ID'];
                    $user_id = $_SESSION["ID"];
                    $result = mysqli_query($conn, "SELECT * FROM comments c join users u ON user_nr = u.ID WHERE c.post_nr = '$post_id';  ");
                    $i = 0;
                    foreach ($result as $line) {
                        ?>
                <div class="comment">
                    <div class="flex aic">
                        <img src="<?php echo $line['user_avatar']; ?>" alt="err">
                        <h5>
                            <?php echo $line['username']; ?>
                        </h5>
                    </div>
                    <p>
                        <?php echo $line['comment']; ?>
                    </p>
                </div>

                <?php $i++;
                    }
                    if (!$i) {
                        ?>
                <?php
                    }
                    ?>
            </div>
        </div>

        <?php } ?>

    </div>
</main>

<?php include("./includes/footer.php"); ?>