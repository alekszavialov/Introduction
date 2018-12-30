<?php if (!empty($data)): ?>
    <form action="../core/handler.php" method="post">
        <?php foreach ($data as $id => $name): ?>
            <div>
                <label for="<?= $id ?>"><input type="radio" id="<?= $id ?>" name="name" value
                    ="<?= $name ?>"><?= $name ?></label>
            </div>
        <?php endforeach; ?>
        <input type="submit" value="Make vote">
    </form>
<?php endif; ?>
