<?php

class FileHandle {

    function folder_check($dir) {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        chmod($dir, 0755);
    }

    function arr2ini(array $a, array $parent = array()) {
        $out = '';
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                //subsection case
                //merge all the sections into one array...
                $sec = array_merge((array) $parent, (array) $k);
                //add section information to the output
                $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
                //recursively traverse deeper
                $out .= $this->arr2ini($v, $sec);
            } else {
                //plain key->value case
                $out .= "$k=$v" . PHP_EOL;
            }
        }
        return $out;
    }

    function save_array_to_ini_file($array, $filename) {
        $convert_array = $this->arr2ini($array);
        if (file_put_contents($filename, $convert_array)) {
            return true;
        }
        return false;
    }

    function csv_to_array($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * Function to set data to csv file from array, what was get content from database 
     * @param unknown $arr - array from table
     * @param unknown $header - header of csv file
     * @param unknown $field_content - field content of array
     * @param unknown $filename - name of csv file
     */
    function save_rsTable_to_CSV($arr, $header, $field_content, $filename) {
        $result = array();

        $fp = fopen($filename, 'w');
        fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

        $field_content = explode(",", $field_content);


        fputcsv($fp, explode(",", $header));
        foreach ($arr AS $key => $item) {
            foreach ($field_content AS $field) {
                $result[$key][] = $item[$field];
            }

            fputcsv($fp, $result[$key]);
        }

        fclose($fp);
    }

    function convert_rsTable_to_CSV($arr, $header, $field_content) {
        $result = array();
        $field_content = explode(",", $field_content);

        $result[0] = explode(",", $header);
        foreach ($arr AS $key => $item) {
            foreach ($field_content AS $field) {
                $result[$key][] = $item[$field];
            }
        }

        return $result;
    }

    function get_type($file_name) {
        $arr = explode(".", $file_name);
        if (count($arr) < 2) {
            return false;
        }
        return end($arr);
    }

    function remove_allFile($dir) {
        if ($handle = opendir("$dir")) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dir/$item")) {
                        remove_directory("$dir/$item");
                    } else {
                        unlink("$dir/$item");
                    }
                }
            }
            closedir($handle);
        }
    }

}
