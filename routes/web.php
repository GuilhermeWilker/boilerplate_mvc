<?php

namespace routes;
use app\controllers\HomeController;

return [
  ['GET', '/', [HomeController::class, 'index']]
];