<h1>Attributes</h1>
<span>
    Used on Routing system of project.<br/>
    <a href="https://www.php.net/manual/en/language.attributes.php">Documentation</a>
</span>

<pre>
Example:
namespace App\Controllers;

use App\System\Config;
use App\System\Routing\Route;
    
    #[Route('/')]
    public function index($id = null, $index = null): void
    {
        ...
    }
</pre>

<hr/>