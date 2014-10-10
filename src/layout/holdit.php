<html xmlns="http://www.w3.org/1999/xhtml" >
<?php   $this->inc->doinclude($this->head); ?>
    <body>
<?php   $this->inc->doinclude($this->scriptinc); ?>
        <div id="Title" >
            TITLE
        </div>

<?php // There was an error
        if( $this->status < 0){ ?>
            <div id="Message_err" >
                <p class="Err"><?php echo $this->message;?></p>
            </div>
            <div class="Linkbox">
                <a class="Link" href="index.php">Back to start</a>
            </div>
<?php }else{ // everything went correct ?>
            <div id="Message" >
                <p class="Text"><?php echo $this->message;?></p>    
                <p class="Access_Id"><?php echo $this->access_id;?></p>
            </div>

            <div class="Linkbox">
                <p class="Link">Now..</p>
                <a class="Link" href="index.php">..to start</a>
                <a class="Getit" href="index.php?action=getit&AID=<?php echo $this->access_id;?>">..get your hold</a>
            </div>
<?php } ?>
    </body>
</html>
