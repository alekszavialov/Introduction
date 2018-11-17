<?php
include_once(dirname(__DIR__). DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'template' .
    DIRECTORY_SEPARATOR . 'header.php');
include_once (dirname(__DIR__). DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'app' .
    DIRECTORY_SEPARATOR . 'printVotesVariables.php');
?>
<body>
<form action="handler/handle.php" method="post">
<!--    <div>-->
<!--        <label for="name1"><input type="radio" id="name1" name="name" value-->
<!--            ="Ivan">Ivan</label>-->
<!--    </div>-->
<!--    <div>-->
<!--        <label for="name2"><input type="radio" id="name2" name="name" value-->
<!--            ="Alex">Alex</label>-->
<!--    </div>-->
<!--    <div>-->
<!--        <label for="name3"><input type="radio" id="name3" name="name" value-->
<!--            ="Nikolai">Nikolai</label>-->
<!--    </div>-->
<!--    <div>-->
<!--        <label for="name4"><input type="radio" id="name4" name="name" value-->
<!--            ="Dora">Dora</label>-->
<!--    </div>-->
<!--    <input type="submit" value="Make vote">-->
    <?php
        $test = new \votes\printVoteVariables();
    ?>
</form>
</body>
</html>
