<?php require('header.php') ?>

<style type="text/css">
    .comments{
        margin-bottom: 20px;
        font-size: 0.8em;
    }
    .date, .author{

        margin-right: 10px;
    }

    .content{
        padding-top: 5px;
        padding-left: 20px;
    }
    .entry{
        padding-left: 10px;
    }
    h1{
        padding-bottom: 10px;
    }
</style>

<h1>Entries in my blog</h1>

<?php foreach ($records as $row): ?>

    <div class="entry">
        <h3><a href="?act=view-entry&id=<?=$row['id']?>"><?=$row['header']?></a></h3>
        <p class="content"><?=$row['content']?></p>
    <div class="comments">
        <span class="date"><?=$row['date']?></span>
        <span class="author"><?=$row['author']?></span>
        <a href="?act=view-entry&id=<?=$row['id']?>"><?=$row['comments']?>comments</a>
        </div>
    </div>
<?php endforeach ?>

<?php if (IS_ADMIN): ?>
<h1>Add new entry:</h1>

<form action="?act=do-new-entry" method="POST" class="well">
    <label>Author</label>
    <input name="author" />
    <label>Header</label>
    <input name="header" type="text"/>
    <label>Content</label>
    <textarea name="content"></textarea>
    <div style="padding-top: 10px;"></div>
        <button type="submit" class="btn">
            Post
        </button>

</form>

<?php endif ?>

<h2>Add new comment:</h2>

<form action="?act=do-new-comment" method="POST" class="well">
    <label>Author</label>
    <input name="author" type="text" />
    <label>Content</label>
    <textarea name="content"></textarea>
    <div style="..."></div>
        <button type="submit" class="btn">
            Post
        </button>

</form>


<?php require ('footer.php') ?>
