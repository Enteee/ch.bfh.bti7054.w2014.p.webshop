<html xmlns="http://www.w3.org/1999/xhtml">
<?php   $this->inc->doinclude($this->head); ?>
<body>
<?php   $this->inc->doinclude($this->scriptinc); ?>
    <div id="header">
        <div id="logo"><img src="<?php echo $this->logo; ?>" alt="logo" /></div>
        <div id="account"><a href="#">Sign in</a> | <a href="#">Sign up</a></div>
    </div>
    
    <div class="clear"></div>
    
    <div id="navigation">
        <div id="buttons">
            <ul>
                <li class="myitems"><a href="#">My items</a></li>
                <li class="shoppingcart"><a href="#">Shopping cart</span></a></li>
                <li class="myproducts"><a href="#">My products</a></li>
                <li class="addproduct"><a href="#">Add product</a></li>
            </ul>
        </div>
        <div id="search">
            <input type="text"></input>
        </div>
        
    </div>
    
    <div class="clear"></div>
    
    <div id="categories">
        <ul>
<?php   foreach($this->categories as $category):?>
            <li><a href="#"><?php echo $category->get_name()?></a></li>
<?php   endforeach; ?>
        </ul>
    </div>
    <div id="main">
        <div>
            <!-- test area -->
            <h1>Header 1 test</h1>
            <h2>Header 2 test</h2>
            <h3>Header 3 test</h3>
            <h4>Header 4 test</h4>
            <h5>Header 5 test</h5>
            <h6>Header 6 test</h6>
<pre>
prformated test
sdkjfhsjkfhsjkfhkjh kjh jkh
</pre>

            text before
            <a class="button save">Save that shit!</a>
            <a class="button add">Hinzufüegula</a>
            <a class="button delete">Löschulation</a>
            <a class="button up">&nbsp;</a>
            <a class="button down">&nbsp;</a>
            text after
            
            <div class="buttons">
                <a class="button left">Button left</a><a class="button middle">Button middle</a><a class="button right">Button right</a>
            </div>
            <div class="clear">kjhgjhg</div>
            <em>emphasis</em>
        </div>
<?php   foreach($this->products as $product): ?>
        <div class="item">
            <div class="name"><?php echo $product->get_name(); ?></div>
            <div class="tags">
<?php       foreach($product->get_tags() as $tag):?> 
                <a class="button"><?php echo $tag ?></a>
<?php       endforeach; ?>
            </div>
            <div class="description"><?php echo $product->get_description() ?></div>
            <div class="options">
                Language:
                <select>
<?php       foreach($product->get_languages() as $language): ?>
                    <option><?php echo $language ?></option>
<?php       endforeach;?>
                </select>
                Version:
                <select>
<?php       foreach($product->get_versions() as $version): ?>
                    <option><?php echo $version ?></option>
<?php       endforeach;?>
                </select>
                Comments:
                <input type="checkbox" checked="checked"></input>
                Support:
                <input type="checkbox"></input>             
            </div>
        </div>
<?php   endforeach; ?>
    </div>
    
    <div class="clear"></div>
    
    <div id="footer">
        Copyright &copy; 2014 CodeShop
    </div>
</body>

</html>
