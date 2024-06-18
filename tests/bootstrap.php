<?php

/**
 * LLC Alfa-forex.
 *
 * The following source code is PROPRIETARY AND CONFIDENTIAL. Use of this
 * source code is governed by the LLC Alfa-forex. Non-Disclosure Agreement
 * previously entered between you and LLC Alfa-forex.
 *
 * By accessing, using, copying, modifying or distributing this software,
 * you acknowledge that you have been informed of your obligations under
 * the Agreement and agree to abide by those obligations.
 */

declare(strict_types=1);

use Symfony\Component\ErrorHandler\ErrorHandler;

require dirname(__DIR__) . '/vendor/autoload.php';

set_exception_handler([new ErrorHandler(), 'handleException']);
