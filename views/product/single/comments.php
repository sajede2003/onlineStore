<?php 
if (!isset($comment[0])): ?>
    <h4>the comments are empty</h4>
<?php else:?>
    <?php foreach ($comment[0] as $fatherItem) : ?>
        <div class="card p-2 mb-2" >
            <div>
                <h4><?=$fatherItem['full_name']?></h4>
            </div>
            <p>
                <?= $fatherItem['content']?>
            </p>
            <div>
                <label for="#">replay:</label>
                <input type="radio" name="replay" value="<?=$fatherItem['id'] ?>" class="replay">
            </div>
        </div>
     <?php  
     if(isset($comment[$fatherItem['id']]))
            recursive($comment[$fatherItem['id']] ,$comment); ?>
    <?php endforeach;?>
<?php endif;?>
<!-- replay comment -->
<?php function recursive($array , $comment){
    foreach ( $array as $childItem): ?>
       <div class="card p-2 mb-2 bg-info">
            <div>
                <h4><?=$childItem['full_name']?></h4>
            </div>
            <p>
                <?=$childItem['content']?>
            </p>
            <div>
                <label for="#">replay :</label>
                <input type="radio" name="replay" class="replay" value="<?=$childItem['id']?>">
            </div>
       </div> 
       <?php  
            if(isset($comment[$childItem['id']]))
                recursive($comment[$childItem['id']] ,$comment); ?>
        
    <?php endforeach; }?>
