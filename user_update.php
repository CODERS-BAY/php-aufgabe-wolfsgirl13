<?php include('header.php')?>


<div class="w-50 img-fluid rounded mx-auto d-block">
    <div class="card my-auto shadow">
        <div class="card-body">
            <div id="pop_up" class="form_box">
            <form id="change_user" action="add_pic_ma.php" method="post"
                                            enctype="multipart/form-data" mt-4>
                    <!-- wenn man datei mitschickt-->
                    <h2>User ändern</h2>
                    <div class="form-group">
                        <label>Userimage</label>
                        <input type="file" name="userimage" />
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                        <!--Userimage hinzufügen-->
                        <input type="submit" value="Userdaten ändern">
                        <!--Button zum Abschicken-->
                </form>
            </div>
        </div>
    </div>
</div>