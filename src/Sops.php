
<?php

// namespace LinkORB\Shipyard;

class Sops
{

    private $sopscmd = 'sops';

    public function __construct()
    {
        if (!$this->commandExist($this->sopscmd)) {
            throw new \RuntimeException('Sops command not found. Please install sops via https://github.com/getsops/sops.');
        }
    }

    public function encrypt($key, $filePath, $method = 'age')
    {

        if (!file_exists($filePath)) {
            throw new \RuntimeException(sprintf('File not found to encrypt. %s', $filePath));
        }

        $targetPath = $this->genEncryptPath($filePath);

        $cmd = $this->sopscmd . " -e --age " . $key . " " . $filePath . " > " . $targetPath . " 2>&1";
        $return = shell_exec($cmd);
        if ($return) {
            throw new \RuntimeException($return);
        }
    }

    public function decrypt($filePath)
    {

        if (!file_exists($filePath)) {
            throw new \RuntimeException(sprintf('File not found to decrypt. %s', $filePath));
        }

        $targetPath = $this->genDecryptPath($filePath);

        $cmd = $this->sopscmd . " -d " . $filePath . " > " . $targetPath . " 2>&1";
        $return = shell_exec($cmd);
        if ($return) {
            throw new \RuntimeException($return);
        }
    }

    private function genEncryptPath($srcPath)
    {
        $path_parts = pathinfo($srcPath);
        return $path_parts['dirname'] . '/' . $path_parts['filename'] . $this->sopscmd . $path_parts['extension'];
    }

    private function genDecryptPath($srcPath)
    {
        $path = str_replace($this->sopscmd . '.', '', $srcPath, $count);
        if (!$count) {
            throw new \RuntimeException('Decrypt file name is wrong.');
        }
        return $path;
    }

    private function commandExist($cmd)
    {
        $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
        return !empty($return);
    }
}


$sops = new Sops();
$sops->encrypt("age1tjzcc45rq3rlnt0hd6a77w9p90pdzmq3df7pdgtkrhynyxs25y2qltryk0", "test.json");
$sops->decrypt("test.sops.json");
?>

