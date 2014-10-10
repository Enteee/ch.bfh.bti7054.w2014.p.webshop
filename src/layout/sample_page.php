<html xmlns="http://www.w3.org/1999/xhtml" >
<?php   $this->inc->doinclude($this->head); ?>
    <body>
<?php   $this->inc->doinclude($this->scriptinc); ?>
        <div id="Title" >
            Can You hold This?...
        </div>

<?php if (is_string($this->message)){ ?>
        <div class="Statusbar" id="Message" >
            <p class="Text"><?php echo $this->message;?></p>
        </div>
<?php }?>
        <div id="Holdit" >
            <form action="index.php" enctype="text/plain" method="get" name="select_holdtype">
                <select id="displayselect" name="displayholdtype" size="1" >
                    <option value="File"<?php echo ($this->displayholdtype == 'File')? ' selected="selected"':'';?>>File</option>
                    <option value="Desk"<?php echo ($this->displayholdtype == 'Desk')? ' selected="selected"':'';?>>Desk</option>
                </select>
                <button type="submit" class="visibleelement">Change</button>
            </form>
<?php switch($this->displayholdtype){
    case 'File': ?>
            <form action="?action=holdfile" enctype="multipart/form-data" method="post" name="file_upload">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $this->max_file_size;?>">
                <input name="holdfile" type="file" />
                <button name="holdit" type="submit" class="visibleelement" >Hold it!</button>
            </form>
            <img id="Progressbar" name="progress_holdfile" class="hiddenelement" src="layout/images/progressbar/transparent.png" Title="upload progress"/>
            <img id="Progressbar" name="progress_fill_status" class="hiddenelement" src="layout/images/progressbar/transparent.png"/ Title="fill status">
<?php   break;
    case'Desk': ?>
            <form action="?action=holddesk" enctype="multipart/form-data" method="post" name="desk_holding">
                <button name="holddesk" type="submit">Start desk!</button>
            </form>
<?php break;
    } ?>
        </div>
        <div id="Getit" >
            Give it<br />
            <form action="index.php" enctype="text/plain" method="get" name="getit">
                <input name="action" type="hidden" value="getit" src="layout/images/transparent.png"/>              
                <input name="AID" type="text"/>
                <button type="submit">Get it!</button>
            </form>
        </div>

<?php if ($this->showdesk === 'true'){ ?>
        <div class="Desk">
            <p class="Text">AID:<?php echo $this->access_id;?></p>
<?php   foreach($this->desk_data as $holddata){ ?>
            <div class="DeskItem_<?php echo $holddata['Type'];?>">
                <img class="Icon" src="layout/images/fileicons/<?php echo $holddata['Icon'];?>" alt="Icon-<?php echo $holddata['Icon'];?>" />
                <p class="Text"><?php echo $holddata['Access_id'];?></p>
                <p class="Text"><?php echo $holddata['Type'];?></p>
                <p class="Text"><?php echo $holddata['Time'];?></p>
                <p class="Text"><?php echo $holddata['Last_Access'];?></p>
                <p class="Text"><?php echo $holddata['Access_Count'];?></p>
                <a class="Getit" href="index.php?action=getit&AID=<?php echo $holddata['Access_id'];?>">..get your hold</a>
            </div>
<?php   } ?>
        </div>
<?php   } ?>


    </body>
</html>
