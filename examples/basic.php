<?PHP

require __DIR__ . '/../crispsdk.php';

use richbarrett\crispsdk\crispsdk;

$sdk = new crispsdk;
$sdk->authenticate('YOUR_IDENTIFER', 'YOUR_KEY');

$r = $sdk->listWebsites();

print_r($r);

?>