<?php
//logout script
session_start();
session_unset();
session_destroy();

header("location: ../?message=loggedout");
