<?php include("../includes/head.php"); ?>
<main>
    <label for="search-input">Suchen</label>
    <input type="search" id="search-input" placeholder="Suche..">
    <div id="results" class="flex fd-col aic jcc">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users; ");
        foreach ($result as $line) {
            ?>
        <a href="../showuser/?user_id=<?php echo $line['ID']; ?>">
            <div class="acc">
                <img src="<?php echo $line['user_avatar']; ?>" alt="">
                <h2 class="headLine">
                    <?php echo $line['username']; ?>
                </h2>
            </div>
        </a>
        <?php } ?>
    </div>
</main>

<?php include("../includes/footer.php"); ?>