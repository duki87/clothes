<?php
  define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/clothes/');
  define('CART_COOKIE','SBwi72UCklwidsa3f');
  define('CART_COOKIE_EXPIRE', time() + (86400 *30));
  define('TAXRATE', 0.2);
  define('CURRENCY', 'usd');
  define('CHECKOUTMODE', 'TEST'); //Change test to live when you are ready to go live
  if(CHECKOUTMODE == 'TEST') {
    define('STRIPE_PRIVATE', 'sk_test_BJCfdKlRB8d2iXLCAsk9a17m');
    define('STRIPE_PUBLIC', 'pk_test_tM70IyoPXZDaGpGYDDhenoYQ');
  }

  if(CHECKOUTMODE == 'LIVE') {
    define('STRIPE_PRIVATE','');
    define('STRIPE_PUBLIC','');
  }
