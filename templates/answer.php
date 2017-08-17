<div class = 'answers'>
    <img id="LIKE" src = "images/You Logo.png"/>
    <div class="who"><p><?php echo $post["userWho"]; ?></p></div>
    <div class="where"><?php echo $post["userWhere"]; ?></div>
    <div><?php echo $post["dateCreated"]; ?></div>
    <br>
    <div class="list">
        <?php echo $post["content"]; ?>
    </div>
</div>