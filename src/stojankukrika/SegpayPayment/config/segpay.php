<?php
return [
    /*
	|------------------------------------------------------------------------------------
	| Segpay package
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_package'   => getenv('SEGPAY_PACKAGE',null),

    /*
	|------------------------------------------------------------------------------------
	| Segpay user id
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_user_id'   => getenv('SEGPAY_USER_ID', null),

    /*
	|------------------------------------------------------------------------------------
	| Segpay user access key
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_user_access_key'   => getenv('SEGPAY_USER_ACCESS_KEY', null),

    /*
	|------------------------------------------------------------------------------------
	| Segpay URL ID
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_url_id'   => getenv('SEGPAY_URL_ID', null),

    /*
	|------------------------------------------------------------------------------------
	| Segpay x-auth-link
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_x_auth_link'   => getenv('SEGPAY_X_AUTH_LINK', null),
    /*
	|------------------------------------------------------------------------------------
	| Segpay x-auth-text
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_x_auth_text'   => getenv('SEGPAY_X_AUTH_TEXT', null),

    /*
	|------------------------------------------------------------------------------------
	| Segpay x-decl-link
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_x_decl_link'   => getenv('SEGPAY_X_DECL_LINK', null),
    /*
	|------------------------------------------------------------------------------------
	| Segpay x-decl-text
	|------------------------------------------------------------------------------------
	|
	*/
    'segpay_x_decl_text'   => getenv('SEGPAY_X_DECL_TEXT', null),

];