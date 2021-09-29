<?php
include('./partials/menu.php');
?>

<div id="main-content">
    <div class="wrapper">
        <h1 class="text-center">Welcome</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>

        <br><br>



        <div class="clear-fix">
        </div>
    </div>
</div>
<?php
include('partials/footer.php');
?>