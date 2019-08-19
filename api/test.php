<?php

system("phantomjs test.js", $output);
print_r($output);
