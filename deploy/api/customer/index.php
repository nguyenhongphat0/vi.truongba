<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
die(json_encode(Customer::all()));