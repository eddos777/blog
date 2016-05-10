<?php require('header.php') ?>
<style type="text/css">
    .comments{
      font-size: 0.8em;
      margin-bottom: 20px;
    }
    .comment-header{
        font-size: 0.8em;
    }
    .comment-content{
        padding-left: 10px;
        margin-bottom: 10px;
    }
    .date, .author{
        margin-right: 10px;
    }
     .content {
         padding-top: 5px;
         padding-left: 15px;
     }
     h2{
         margin-bottom: 10px;
     }
</style>

    <h3><?=$ENTRY['header']?></h3>
    <p class="content"><?=$ENTRY['content']?></p>
    <div class="comments">
        <span class="date"><?=$ENTRY['date']?></span>
        <span class="author"><?=$ENTRY['author']?></span>
    </div>


<h2>Comments</h2>
<?php foreach ($comments as $row): ?>

    <div class="comments">
        <div class="comment-header">
            <span class="date"><?=$row['date']?></span>
            <span class="author"><b><?=$row['author']?></b></span>
        </div>
        <p class="comment-content"><?=$row['content']?></p>
    </div>
<?php endforeach ?>
<?php require ('footer.php') ?>

