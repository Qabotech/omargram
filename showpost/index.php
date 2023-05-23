<?php include("../includes/head.php"); ?>
<?php
$post_ID = $_GET["postid"];
if (isset($post_ID)) { ?>

<main>
    <div id="posts" class="flex fd-col jcc aic">
        <?php
            $result = mysqli_query($conn, "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.ID WHERE posts.Post_ID = '$post_ID' ORDER BY posts.Post_ID DESC; ");
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
                    <?php
                            $existing = "unliked fa-regular";
                            $result = mysqli_query($conn, "SELECT * FROM liked");
                            foreach ($result as $line) {
                                if ($line["user_id"] == $_SESSION["ID"] && $line["post_id"] == $row['Post_ID']) {
                                    $existing = "liked fa-solid";
                                } else {
                                    $existing = "unliked fa-regular";
                                }
                            }
                            ?>
                    <i class="fa-regular fa-heart like-post <?php echo $existing; ?>"
                        id="like-post-<?php echo $row['Post_ID']; ?>"></i>


                    <i class="fa-regular fa-comment"
                        onclick="toggleShow('#comment-form-<?php echo $row['Post_ID']; ?>')"></i>
                    <i class="fa-regular fa-paper-plane"
                        onclick="copyToClipboard(window.location.href +'../showpost/?postid='+<?php echo $row['Post_ID']; ?>),window.location.href = '../showpost/?postid='+<?php echo $row['Post_ID']; ?>"></i>
                </div>
                <h3><span id="like-count-<?php echo $row['Post_ID']; ?>"><?php echo $row['likes']; ?></span> Likes</h3>
                <input type="hidden" id="user_id">
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
<?php
} else {
    ?>
<main class="flex jcc aic">
    <h1 style="font-size:3em;"> Post Nicht gefunden <i class="fa-solid fa-circle-exclamation"></i></h1>
</main>
<?php } ?>
<?php include("../includes/footer.php"); ?>