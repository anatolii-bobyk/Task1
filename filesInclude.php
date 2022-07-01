<?php

foreach (glob("Models/*.php") as $filename) {
    require_once $filename;
}
