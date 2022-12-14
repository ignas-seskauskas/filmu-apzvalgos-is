    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        $.ajax({
            url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/user/controller'; ?>",
            type: 'POST',
            data: {
                action: 'logout',
            },
            success: (response) => {
                console.log(response)
            },
            error: console.log,
            complete: console.log
        });
    </script> -->
    <?php
    unset($_SESSION["user"]);
    header("location:index.php");
    exit();
