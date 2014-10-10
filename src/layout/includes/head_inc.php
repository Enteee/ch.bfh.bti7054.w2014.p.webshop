    <head>
        <!-- Page information -->
        <title><?php echo $this->title;?></title>
        <meta name="subtitle" content="<?php echo $this->subtitle;?>" />
        <meta name="author" content="<?php echo $this->author;?>" />
        <meta name="contact" content="<?php echo $this->mail;?>" />
        <!-- Stylesheet -->
        <meta http-equiv="content-style-type" content="text/css" />
<?php   foreach($this->css as $css){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $css;?>" />
<?php
    }
?>
        <!-- Additional metadata -->
<?php   foreach($this->metadata as $key => $val){ ?>
        <meta name="<?php echo $key;?>" content="<?php echo $val;?>" /> 
<?php
    }
?>
    </head>
