<?php
include __DIR__ . '/vendor/autoload.php';

$finder = new \Symfony\Component\Finder\Finder();

$files = $finder->in('./tests/Model/')->files();
foreach ($files as $file) {
    $content = file_get_contents($file->getPathname());
    $filename = str_replace('Test', '', pathinfo($file->getFilename(), PATHINFO_FILENAME));
    $content = preg_replace("/namespace Slince\\\\Shopify\\\\Tests\\\\.*/", "namespace Slince\Shopify\Tests\Model;", $content);
//    var_dump($content);
    $content = str_replace("use Slince\Shopify\Tests\Base\ModelTestCase;", "", $content);

    $content = preg_replace("/use Slince\\\\Shopify\\\\Manager.*/", "use Slince\\Shopify\\Model\\$filename;", $content);
//    var_dump($content);

    file_put_contents($file->getPathname(), $content);
}