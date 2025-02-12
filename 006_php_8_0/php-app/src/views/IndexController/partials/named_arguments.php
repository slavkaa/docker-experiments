<a id="named-arguments"></a>
<h1>Named arguments</h1>
<span>
    <ul>
        <li>Specify only required parameters, skipping optional ones.</li>
        <li>Arguments are order-independent and self-documented.</li>
    </ul>
    <a href="https://www.php.net/manual/en/language.attributes.php">Documentation</a>
</span>

<pre>
Example:
Config::getPathToView(subPath: 'index.php'); // at regular class call
#[Route(routePath: '/attributes/routing')]   // at Attribute call
</pre>

<hr/>