<?php
include_once("header.php");
?>
<body>
<form action="handler/handle.php" method="post">
    <div>
        <label for="name1"><input type="radio" id="name1" name="name" value
            ="Ivan">Ivan</label>
    </div>
    <div>
        <label for="name2"><input type="radio" id="name2" name="name" value
            ="Alex">Alex</label>
    </div>
    <div>
        <label for="name3"><input type="radio" id="name3" name="name" value
            ="Nikolai">Nikolai</label>
    </div>
    <div>
        <label for="name4"><input type="radio" id="name4" name="name" value
            ="Dora">Dora</label>
    </div>
    <input type="submit" value="Make vote">
    <p>
        <?php
        if ($_SESSION["error"]) {
            echo $_SESSION["error"];
            session_destroy();
        } ?>
    </p>
</form>
</body>
</html>
