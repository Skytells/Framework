<?
function extract_namespace($file) {
    $ns = NULL;
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'namespace') === 0) {
                $parts = explode(' ', $line);
                $ns = rtrim(trim($parts[1]), ';');
                break;
            }
        }
        fclose($handle);
    }
    return $ns;
}
