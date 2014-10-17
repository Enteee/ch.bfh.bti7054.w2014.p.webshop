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
            <li><a href="#">Snippets</a></li>
            <li><a href="#">Scripts</a></li>
            <li><a href="#">Full software</a></li>
            <li><a href="#">Classes</a></li>
            <li><a href="#">Frameworks</a></li>
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
    
        <div class="item">
            <div class="name">Name</div>
            <div class="tags">
                <a class="button">Tag 1</a><a class="button">Tag 2</a><a class="button">Tag 3</a>
            </div>
            <div class="description">Description</div>
            <div class="options">
                Language:
                <select>
                    <option>C</option>
                    <option>Java</option>
                </select>
                Version:
                <select>
                    <option>alpha</option>
                    <option>1.0</option>
                    <option>1.1</option>                    
                </select>
                Comments:
                <input type="checkbox" checked="checked"></input>
                Support:
                <input type="checkbox"></input>             
            </div>
        </div>
    </div>
    
    <div class="clear"></div>
    
    <div id="footer">
        Copyright &copy; 2014 CodeShop
    </div>
</body>

</html>
