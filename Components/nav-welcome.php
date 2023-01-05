<div class="m-auto d-flex justify-content-between p-3 bg-transparent-light">
    <h2>Benvingut <?php echo ($_SESSION["user"]) ?></h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="tancar-sessio" class="btn btn-danger ml-0">Tancar Sessió</button>
    </form>
</div>
<?php if (isset($_POST['tancar-sessio'])) {
    include "functions/tancarSessio.php";
    tancarSessio();
}
?>