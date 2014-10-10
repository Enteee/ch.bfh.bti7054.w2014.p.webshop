<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>CodeShop - never code again!</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="header">
        <div id="logo">CodeShop Logo</div>
        <div id="account"><a href="#">Sign in</a> | <a href="#">Sign up</a></div>
    </div>
    <div id="navigation">
        <div id="buttons">
            <ul>
                <li>[My items]</li>
                <li>[Shopping cart]</li>
                <li>[My products]</li>
                <li>[Add product]</li>
            </ul>
        </div>
        <div id="search">
            <input type="text"></input>
        </div>
    </div>
    <div id="categories">
        <ul>
            <li>Snippets</li>
            <li>Scripts</li>
            <li>Full software</li>
            <li>Classes</li>
            <li>Frameworks</li>
        </ul>
    </div>
    <div id="main">
        <div class="item">
            <span>Name</span>
            <div>[Tag1] [Tag2] [Tag3]</div>
            <span>Description</span>
            <div>
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
    <div id="footer">
        Copyright &copy; 2014 CodeShop
    </div>
</body>

</html>
